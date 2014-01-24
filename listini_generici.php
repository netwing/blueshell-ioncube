<?php
require_once("config.inc.php");
$blue->autentica_utente("listini","W");
require_once "views/site/page_upgrading.php";
/*
$select_anni="SELECT DISTINCT(listino_generico_anno) AS anni FROM ".$tabelle['listini_generici']." ORDER BY listino_generico_anno ASC";
$result_anni=$sql->select_query($select_anni);
$paginazione_anni="";
while ($row_anni=mysql_fetch_array($result_anni))
{
	$paginazione_anni.="<a href=\"listini_generici.php?anno=".$row_anni['anni']."\">".$row_anni['anni']."</a> | ";
}
$anno=date("Y",time());
if (array_key_exists("anno",$_GET))
{
	$_SESSION['listini_anno']=substr($_GET['anno'],0,4);
}
if (array_key_exists("listini_anno",$_SESSION) and $_SESSION['listini_anno']!="")
{
	$anno=$_SESSION['listini_anno'];
}
if (count($_POST)>0)
{
	$select_id="SELECT listino_generico_id FROM ".$tabelle['listini_generici']." WHERE listino_generico_anno='".$anno."' ORDER BY listino_generico_id";
	$result_id=$sql->select_query($select_id);
	while ($row_id=mysql_fetch_array($result_id))
	{
		if (array_key_exists($row_id['listino_generico_id'],$_POST['descrizione']))
		{
			$descrizione=$sql->pulisci($_POST['descrizione'][$row_id['listino_generico_id']]);
			$costo=$sql->decimale_sql($_POST['costo'][$row_id['listino_generico_id']]);
			$update="UPDATE ".$tabelle['listini_generici']." SET listino_generico_descrizione='".$descrizione."',listino_generico_costo='".$costo."' WHERE listino_generico_id='".$row_id['listino_generico_id']."'";
			$sql->update_query($update);
		}
	}
	if ($_POST['descrizione_nuovo']!="" and $_POST['costo_nuovo']!="")
	{
		$descrizione=$sql->pulisci($_POST['descrizione_nuovo']);
		$costo=$sql->decimale_sql($_POST['costo_nuovo']);
		$insert="INSERT INTO ".$tabelle['listini_generici']." (listino_generico_anno,listino_generico_descrizione,listino_generico_costo) VALUES ('".$anno."','".$descrizione."','".$costo."')";
		$sql->insert_query($insert);
	}
}
if (count($_GET)>0)
{
	if (array_key_exists("del",$_GET))
	{
		$delete="DELETE FROM ".$tabelle['listini_generici']." WHERE listino_generico_id='".$_GET['del']."'";
		$sql->delete_query($delete);
	}
}

$select_listino="SELECT * FROM ".$tabelle['listini_generici']." WHERE listino_generico_anno='".$anno."' ORDER BY listino_generico_descrizione ASC";
$result_listino=$sql->select_query($select_listino);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="stile.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php include_once("top.php"); ?>
<table width="900" border="0" cellpadding="0" cellspacing="0" id="tabellaScheda">
	<tr>
		<td class="schedaCurvaTopLeft">&nbsp;</td>
		<td class="schadaOmbraTop">&nbsp;</td>
		<td class="schedaCurvaTopRight">&nbsp;</td>
	</tr>
	<tr>
		<td class="schedaOmbraLeft">&nbsp;</td>
		<td>
    			<form action="listini_generici.php?anno=<?php echo $anno; ?>" method="post" name="form1" id="form1">
    				<table width="100%"  border="0" cellspacing="2">
    					<tr>
    					  <td class="topRigaGrigia"><img src="img/top_listini_generici.gif" width="650" height="63" border="0" /></td>
  					  </tr>
    					<tr>
    						<td><strong>Anno: <?php echo $paginazione_anni; ?></strong></td>
   						</tr>
    					<tr>
    						<td>Stai guardando il listino generico dell'anno <?php echo $anno; ?> </td>
   						</tr>
    					<tr>
    						<td class="tdContenutoVisualizzazione">&nbsp;</td>
   						</tr>
						<?php
						while ($row_listino=mysql_fetch_array($result_listino))
						{
						?>
    					<tr>
    						<td class="tdContenutoVisualizzazione">
							Descrizione	<input name="descrizione[<?php echo $row_listino['listino_generico_id']; ?>]" type="text" id="descrizione" value="<?php echo $row_listino['listino_generico_descrizione']; ?>" size="40" />
    						Costo <input name="costo[<?php echo $row_listino['listino_generico_id']; ?>]" type="text" id="costo" value="<?php echo $sql->decimale_ita($row_listino['listino_generico_costo']); ?>" size="10" maxlength="10" /> 
    						<a href="listini_generici.php?del=<?php echo $row_listino['listino_generico_id']; ?>">Elimina questa voce</a></td>
   						</tr>
						<?php
						}
						?>
    					<tr>
    						<td class="tdContenutoVisualizzazione"><strong>Se desideri
    								inserire un nuovo articolo
    								nel listino, scrivilo nel
    								campo sottostante: </strong></td>
   						</tr>
    					<tr>
    						<td class="tdContenutoVisualizzazione">Descrizione
                                <input name="descrizione_nuovo" type="text" id="descrizione_nuovo" size="40" />
Costo
<input name="costo_nuovo" type="text" id="costo_nuovo" size="10" maxlength="10" /></td>
   						</tr>
    					<tr>
    						<td class="tdContenutoVisualizzazione"><input name="Modifica" type="submit" id="Modifica" value="Modifica" /></td>
   						</tr>
				  </table>
	  </form></td>
		<td class="schedaOmbraRight">&nbsp;</td>
	</tr>
	<tr>
		<td class="schedaCurvaBottomLeft">&nbsp;</td>
		<td class="schedaOmbraBottom">&nbsp;</td>
		<td class="schedaCurvaBottomRight">&nbsp;</td>
	</tr>
</table>
</body>
</html>
*/ ?>
