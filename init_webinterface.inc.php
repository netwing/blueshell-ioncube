<?php

// Select language
function getLanguageList()
{
    $translations = array();
    $directoryIterator = new DirectoryIterator(Yii::app()->messages->basePath);
    foreach($directoryIterator as $item)

    if($item->isDir() && !$item->isDot()) {

        $language_id =  $item->getFilename();
        $locale_display_name = ucfirst(Yii::app()->locale->getLocaleDisplayName($language_id, 'languages')) ;
        $other_locale = Yii::app()->getLocale($language_id);
        $other_locale_display_name =  ucfirst($other_locale->getLocaleDisplayName($language_id, "languages"));

        $translations[$language_id] = "$locale_display_name - $other_locale_display_name"; 
    }
    return $translations;    
}

function setLanguage($cookieDays = 180)
{
    $language_list = getLanguageList();        

    $posted_language                = Yii::app()->request->getPost('languageSelector');
    $posted_language_is_valid       = ($posted_language !== null);
    $posted_language_is_available   = array_key_exists($posted_language, $language_list );

    // User posted a change language request
    if($posted_language_is_valid and $posted_language_is_available){
        Yii::app()->setLanguage($_POST['languageSelector']);
        $cookie = new CHttpCookie('language', $_POST['languageSelector']);
        $cookie->expire = time() + 60*60*24*$cookieDays; 
        Yii::app()->request->cookies['language'] = $cookie;
        $_POST = array();
        header("Location:" . Yii::app()->user->returnUrl);
        exit;
    }
 
    // No change langauge request - Lookup into cookies
    $cookie_language                = Yii::app()->request->cookies['language'];
    $cookie_language_is_valid       = (isset(Yii::app()->request->cookies['language']) and is_string($cookie_language->value)) ;
    $cookie_language_is_available   = ($cookie_language_is_valid and array_key_exists($cookie_language->value, $language_list));

    // I've a valid language cookie AND language is supported
    if( $cookie_language_is_available){
        Yii::app()->setLanguage($cookie_language->value);
        return;
    }

    // if we came to this point, the language is set in cookies, but doesn't exist, 
    // so we better unset the cookie
    if($cookie_language_is_valid){
        unset(Yii::app()->request->cookies['language']);
        throw new CHttpException(400, Yii::t('app', 'Invalid request. Translation don\'t exists!'));
        Yii::app()->exit();
    } 

    // No post AND No cookie 
    // So we set base application parameters like language
    if (isset(Yii::app()->request)) {
        if (isset(Yii::app()->request->preferredLanguage) and Yii::app()->request->preferredLanguage != "" ) {
            Yii::app()->language = substr(Yii::app()->request->preferredLanguage,0,2);
        }
    }       
}
setLanguage();

// Set default local key path as constant
define("LOCAL_KEY_NAME", "blueshell_localkey.txt");
define("LOCAL_KEY_WEB_DIRECTORY", "protected/runtime/temp");
define("LOCAL_KEY_DIRECTORY", __DIR__ . DIRECTORY_SEPARATOR . LOCAL_KEY_WEB_DIRECTORY);
define("LOCAL_KEY_PATH", LOCAL_KEY_DIRECTORY . DIRECTORY_SEPARATOR . LOCAL_KEY_NAME);
if (defined('RESET_LOCAL_KEY')) {
    if (RESET_LOCAL_KEY === true) {
        if (file_exists(LOCAL_KEY_PATH)) {
            unlink(LOCAL_KEY_PATH);
        }
    }
}

// Check if local key exists
$local_key = false;
if (file_exists(LOCAL_KEY_PATH)) {
    $local_key = file_get_contents(LOCAL_KEY_PATH);
}
define("LOCAL_KEY", $local_key);

if (PHP_SAPI !== 'cli') {

    // CHECK FOR TRAVIS LICENSE OVERRIDE
    if (LICENSE_KEY == 'a2d62a18f58381a72ee9adddf92c80326233d72d260f8bb11cc6bafb31f04bb647feb379a6eb56a2497133b08b6aa2868bb6a51675ba6d120b72569e49b0e2e7') {
        return true;
    }

    if (LICENSE_KEY == "") {
        $license_message1 = Yii::t('app', "License key not set");
        $license_message2 = Yii::t('app', "Open <code>config.inc.php</code> in your web root and insert a valid license key to continue.</p>");
        require_once "views/site/license_error.php";
        exit;        
    }

    // Check license 
    $results = check_license(LICENSE_KEY, LOCAL_KEY);
    $check_license_results = $results;

    if ($results["status"]=="Active") {
        # Allow Script to Run
        if (array_key_exists('localkey', $results)) {
            # Save Updated Local Key to DB or File
            $localkeydata = $results["localkey"];
            if (!file_exists(LOCAL_KEY_DIRECTORY)) {
                mkdir(LOCAL_KEY_DIRECTORY, 0777, true);
                chmod(LOCAL_KEY_DIRECTORY, 0777);
            }
            if (!file_exists(LOCAL_KEY_PATH)) {
                touch(LOCAL_KEY_PATH);
                chmod(LOCAL_KEY_PATH, 0777);
            }
            $fp = fopen(LOCAL_KEY_PATH, "w+");
            fwrite($fp, $localkeydata);
            fclose($fp);
        }
    } else {
        if ($results["status"]=="Invalid") {
            # Show Invalid Message
            $license_message1 = Yii::t('app', "The license is not valid");
        } elseif ($results["status"]=="Expired") {
            # Show Expired Message
            $license_message1 = Yii::t('app', "The license has expired");
        } elseif ($results["status"]=="Suspended") {
            # Show Suspended Message
            $license_message1 = Yii::t('app', "The license was suspended");
        } else {
            $license_message1 = Yii::t('app', "Unknown error");
        }
        if (array_key_exists('message', $results)) {
            $license_message3 = $results['message'];
        }
        if (array_key_exists('description', $results)) {
            $license_description1 = $results['description'];   
        }
        $license_message2 = Yii::t('app', "Open <code>config.inc.php</code> in your web root and insert a valid license key to continue.</p>");
        require_once "views/site/license_error.php";
        exit;
    }    

}

// require_once "library/Smarty/libs/Smarty.class.php";
define('SMARTY_SPL_AUTOLOAD', 0);
// need this to avoid Smarty rely on spl autoload function,
// this has to be done since we need the Yii autoload handler
if (!defined('SMARTY_SPL_AUTOLOAD')) {
    define('SMARTY_SPL_AUTOLOAD', 0);
} elseif (SMARTY_SPL_AUTOLOAD !== 0) {
    throw new CException('ESmartyViewRenderer cannot work with SMARTY_SPL_AUTOLOAD enabled. Set SMARTY_SPL_AUTOLOAD to 0.');
}

// including Smarty class and registering autoload handler
require_once dirname(__FILE__) . "/vendor/smarty/smarty/distribution/libs/sysplugins/smarty_internal_data.php";
require_once dirname(__FILE__) . "/vendor/smarty/smarty/distribution/libs/Smarty.class.php";

// need this since Yii autoload handler raises an error if class is not found
// Yii autoloader needs to be the last in the autoload chain
spl_autoload_unregister('smartyAutoload');
Yii::registerAutoloader('smartyAutoload'); 

$smarty = new Smarty();

// Assegnamento della funzione
$smarty->compile_check = true;
$smarty->debugging = false;
$smarty->compile_dir = dirname(__FILE__) . "/app/protected/runtime/templates_c";
if (!file_exists($smarty->compile_dir)) {
    mkdir($smarty->compile_dir, 0777);
}
if (!is_writable($smarty->compile_dir)) {
    chmod($smarty->compile_dir, 0777);
}
# Istanzazione degl'oggetti MySql, Form e Blue disponibili in ogni pagina

function array_diff_keys()
{
    $args = func_get_args();
    $res=$args[0];
    if (!is_array($res))
    {
        return array();
    }
    for ($i=1;$i<count($args);$i++)
    {
        if (!is_array($args[$i])) {
            continue;
        }
        foreach ($args[$i] as $key=>$data)
        {
            unset($res[$key]);
        }
    }
    return $res;
}
# Definiamo questa funzione al posto di array_diff_assoc()
//require_once("cpaint/cpaint.inc.php");
//require_once('cpaint/cpaint2.inc.php');


function check_license($licensekey, $localkey="") {
    $whmcsurl = "http://my.netwing.it/";
    $licensing_secret_key = "76682f743ae018364a082b2e87f2d2f5"; # Unique value, should match what is set in the product configuration for MD5 Hash Verification
    $check_token = time().md5(mt_rand(1000000000,9999999999).$licensekey);
    $checkdate = date("Ymd"); # Current date
    $usersip = isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : $_SERVER['LOCAL_ADDR'];
    $localkeydays = 7; # How long the local key is valid for in between remote checks
    $allowcheckfaildays = 3; # How many days to allow after local key expiry before blocking access if connection cannot be made
    $localkeyvalid = false;
    $originalcheckdate = date("Ymd",time(0,0,0,date("m"),date("d")-$localkeydays,date("Y")));
    if ($localkey) {
        $localkey = str_replace("\n",'',$localkey); # Remove the line breaks
        $localdata = substr($localkey,0,strlen($localkey)-32); # Extract License Data
        $md5hash = substr($localkey,strlen($localkey)-32); # Extract MD5 Hash
        if ($md5hash==md5($localdata.$licensing_secret_key)) {
            $localdata = strrev($localdata); # Reverse the string
            $md5hash = substr($localdata,0,32); # Extract MD5 Hash
            $localdata = substr($localdata,32); # Extract License Data
            $localdata = base64_decode($localdata);
            $localkeyresults = unserialize($localdata);
            $originalcheckdate = $localkeyresults["checkdate"];
            if ($md5hash==md5($originalcheckdate.$licensing_secret_key)) {
                $localexpiry = date("Ymd",time(0,0,0,date("m"),date("d")-$localkeydays,date("Y")));
                if ($originalcheckdate>$localexpiry) {
                    $localkeyvalid = true;
                    $results = $localkeyresults;
                    $validdomains = explode(",",$results["validdomain"]);
                    if (!in_array($_SERVER['SERVER_NAME'], $validdomains)) {
                        $localkeyvalid = false;
                        $localkeyresults["status"] = "Invalid";
                        // $results = array();
                    }
                    $validips = explode(",",$results["validip"]);
                    if (!in_array($usersip, $validips)) {
                        $localkeyvalid = false;
                        $localkeyresults["status"] = "Invalid";
                        // $results = array();
                    }
                    if ($results["validdirectory"]!=dirname(__FILE__)) {
                        $localkeyvalid = false;
                        $localkeyresults["status"] = "Invalid";
                        // $results = array();
                    }
                }
            }
        }
    }
    if (!$localkeyvalid) {
        $postfields["licensekey"] = $licensekey;
        $postfields["domain"] = $_SERVER['SERVER_NAME'];
        $postfields["ip"] = $usersip;
        $postfields["dir"] = dirname(__FILE__);
        if ($check_token) $postfields["check_token"] = $check_token;
        if (function_exists("curl_exec")) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $whmcsurl."modules/servers/licensing/verify.php");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $data = curl_exec($ch);
            curl_close($ch);
        } else {
            $fp = fsockopen($whmcsurl, 80, $errno, $errstr, 5);
            if ($fp) {
                $querystring = "";
                foreach ($postfields AS $k=>$v) {
                    $querystring .= "$k=".urlencode($v)."&";
                }
                $header="POST ".$whmcsurl."modules/servers/licensing/verify.php HTTP/1.0\r\n";
                $header.="Host: ".$whmcsurl."\r\n";
                $header.="Content-type: application/x-www-form-urlencoded\r\n";
                $header.="Content-length: ".@strlen($querystring)."\r\n";
                $header.="Connection: close\r\n\r\n";
                $header.=$querystring;
                $data="";
                @stream_set_timeout($fp, 20);
                @fputs($fp, $header);
                $status = @socket_get_status($fp);
                while (!@feof($fp)&&$status) {
                    $data .= @fgets($fp, 1024);
                    $status = @socket_get_status($fp);
                }
                @fclose ($fp);
            }
        }
        if (!$data) {
            $localexpiry = date("Ymd",time(0,0,0,date("m"),date("d")-($localkeydays+$allowcheckfaildays),date("Y")));
            if ($originalcheckdate>$localexpiry) {
                $results = $localkeyresults;
            } else {
                $results["status"] = "Invalid";
                $results["description"] = "Remote Check Failed";
                return $results;
            }
        } else {
            preg_match_all('/<(.*?)>([^<]+)<\/\\1>/i', $data, $matches);
            $results = array();
            foreach ($matches[1] AS $k=>$v) {
                $results[$v] = $matches[2][$k];
            }
        }
        if (array_key_exists('md5hash', $results) and $results["md5hash"]) {
            if ($results["md5hash"]!=md5($licensing_secret_key.$check_token)) {
                $results["status"] = "Invalid";
                $results["description"] = "MD5 Checksum Verification Failed";
                return $results;
            }
        }
        if ($results["status"]=="Active") {
            $results["checkdate"] = $checkdate;
            $data_encoded = serialize($results);
            $data_encoded = base64_encode($data_encoded);
            $data_encoded = md5($checkdate.$licensing_secret_key).$data_encoded;
            $data_encoded = strrev($data_encoded);
            $data_encoded = $data_encoded.md5($data_encoded.$licensing_secret_key);
            $data_encoded = wordwrap($data_encoded,80,"\n",true);
            $results["localkey"] = $data_encoded;
        }
        $results["remotecheck"] = true;
    }
    unset($postfields,$data,$matches,$whmcsurl,$licensing_secret_key,$checkdate,$usersip,$localkeydays,$allowcheckfaildays,$md5hash);
    return $results;
}


function juiDatePicker($id, $value = null) {

    $result = '';

    $options = array(
        'altField'          => '#' . $id,
        'altFormat'         => 'yy-mm-dd',
        'showButtonPanel'   => true,
        'changeMonth'       => true,
        'changeYear'        => true,
    );

    $options = CJavaScript::encode($options);
    $js = "jQuery('#{$id}_user').datepicker($options);";

    if (Yii::app()->language!='' && Yii::app()->language!='en') {
        $result = '<script src="bower_components/jquery-ui/ui/i18n/jquery-ui-i18n.js"></script>' . PHP_EOL;
        $js = "jQuery('#{$id}_user').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['" . Yii::app()->language . "']," . $options . "));";
    }

    // Populate
    if ($value !== null and $value !== '0000-00-00') {
        $js.= 'var myDate = jQuery("#' . $id . '").val(); var parsedDate = jQuery.datepicker.parseDate("yy-mm-dd", myDate); jQuery("#' . $id . '_user").datepicker("setDate", parsedDate);';
    }

    $result.= '<script type="text/javascript">$(function() { ' . $js . ' });</script>';

    return $result;
}
