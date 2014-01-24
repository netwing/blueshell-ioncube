<?php require_once('config.inc.php'); ?>
<?php
$db = mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
    for($k=$_POST['n_pb_da'];$k<=$_POST['n_pb_a'];$k++){    
      $insertSQL = sprintf("INSERT INTO blue_posti_barca (posto_barca_pontile, posto_barca_numero, posto_barca_sequenziale, posto_barca_dimensioni, posto_barca_proprietario, posto_barca_proprietario_data, posto_barca_gestore, posto_barca_gestore_data, posto_barca_disponibile) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                           GetSQLValueString($_POST['pontili'], "int"),
                           GetSQLValueString($k, "int"),
                           GetSQLValueString($k, "int"),
                           GetSQLValueString($_POST['dimensioni'], "int"),
                           GetSQLValueString(1, "int"),
                           GetSQLValueString("NOW()", "date"),
                           GetSQLValueString(1, "int"),
                           GetSQLValueString("NOW()", "date"),
                           GetSQLValueString(1, "int"));
    
    
      mysql_select_db($dbdata, $db);
      $Result1 = mysql_query($insertSQL, $db) or die(mysql_error());
    }
}

mysql_select_db($dbdata, $db);
$query_pontili = "SELECT * FROM blue_pontili";
$pontili = mysql_query($query_pontili, $db) or die(mysql_error());
$row_pontili = mysql_fetch_assoc($pontili);
$totalRows_pontili = mysql_num_rows($pontili);

mysql_select_db($dbdata, $db);
$query_dimensioni = "SELECT * FROM blue_dimensioni ORDER BY dimensione_lunghezza,dimensione_larghezza";
$dimensioni = mysql_query($query_dimensioni, $db) or die(mysql_error());
$row_dimensioni = mysql_fetch_assoc($dimensioni);
$totalRows_dimensioni = mysql_num_rows($dimensioni);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Documento senza titolo</title>
</head>

<body>
<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <input type="hidden" name="MM_insert" value="form1" />
  <table width="500" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td>Seleziona pontile</td>
      <td><select name="pontili" id="pontili">
        <?php
do {  
?>
        <option value="<?php echo $row_pontili['pontile_id']; ?>"><?php echo $row_pontili['pontile_nome']; ?></option>
        <?php
} while ($row_pontili = mysql_fetch_assoc($pontili));
  $rows = mysql_num_rows($pontili);
  if($rows > 0) {
      mysql_data_seek($pontili, 0);
      $row_pontili = mysql_fetch_assoc($pontili);
  }
?>
      </select></td>
    </tr>
    <tr>
      <td>Seleziona dimensione</td>
      <td><select name="dimensioni" id="dimensioni">
        <?php
do {  
?>
        <option value="<?php echo $row_dimensioni['dimensione_id']; ?>"><?php echo $row_dimensioni['dimensione_lunghezza']." x ".$row_dimensioni['dimensione_larghezza']; ?></option>
        <?php
} while ($row_dimensioni = mysql_fetch_assoc($dimensioni));
  $rows = mysql_num_rows($dimensioni);
  if($rows > 0) {
      mysql_data_seek($dimensioni, 0);
      $row_dimensioni = mysql_fetch_assoc($dimensioni);
  }
?>
      </select></td>
    </tr>
    <tr>
      <td>Inserisci numero posti barca da:</td>
      <td><input name="n_pb_da" type="text" id="n_pb_da" size="3" /></td>
    </tr>
    <tr>
      <td>Inserisci numero posti barca a:</td>
      <td><input name="n_pb_a" type="text" id="n_pb_a" size="3" /></td>
    </tr>
    <tr>
      <td colspan="2" align="right"><input type="submit" name="button" id="button" value="Inserisci posti nel pontile" /></td>
    </tr>
  </table>
</form>
</body>
</html>
