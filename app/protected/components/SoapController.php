<?php

ini_set ('soap.wsdl_cache_enabled',0);

class SoapController extends CController
{

    /**
     * Define action handled by CWebServiceAction
     */
    public function actions()
    {
        return array(
            'index'=>array(
                'class'=>'CWebServiceAction',
            ),
        );
    }
 
    /** 
     * @param string the username
     * @param string the password
     * @return boolean
     * @soap
     */
    public function login($username, $password)
    {   
        $identity = new UserIdentity($username, $password);
        $identity->authenticate();
        if ($identity->errorCode == UserIdentity::ERROR_NONE) {
            Yii::app()->user->login($identity, 3600);
            return true;
        }
        else {
            throw new SoapFault("Authentication error", "Unable to login with provided username and password.");
        }
        // $sessionKey = sha1(mt_rand());
        // Yii::app()->cache->set('soap_sessionkey' . $sessionKey . Yii::app()->user->id, $name . ':' . $password, 1800);
        // return $sessionKey;
        return false;
    } 

    /**
     * @return boolean current session is logged
     * @soap
     */
    public function loggedIn()
    {   
        return !Yii::app()->user->isGuest;
    } 


    /**
     * @throw SoapFault exception for not authorized
     */
    protected function accessDenied()
    {
        throw new SoapFault("Authorization error", "You are not authorized to perform this operation.");
    }

    /** 
     * @return boolean
     * @soap
     */
    public function index()
    {   
        return true;
    }

}