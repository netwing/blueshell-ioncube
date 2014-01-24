<?php
define("APPLICATION_LOAD_WEBINTERFACE", false);

require_once "config.inc.php";
$blue->autentica_utente("principale", "R");

$json = array();
if (!array_key_exists('s', $_GET)) {
    $_GET['s'] = null;
}

if ($_GET['s'] == 'clients') {

    // get results count
    $sql = "SELECT COUNT(*) AS total
            FROM {{clienti}} 
            WHERE cliente_nominativo LIKE :search 
            OR cliente_nome LIKE :search 
            OR cliente_cognome LIKE :search";
    $command = Yii::app()->db->createCommand($sql);
    $command->bindValue(':search', '%' . $_GET['q'] . '%', PDO::PARAM_STR);
    $total = $command->queryScalar();

    // get real results
    $sql = "SELECT *
            FROM {{clienti}} 
            WHERE cliente_nominativo LIKE :search 
            OR cliente_nome LIKE :search 
            OR cliente_cognome LIKE :search 
            LIMIT :start, :limit";
    $command = Yii::app()->db->createCommand($sql);
    $command->bindValue(':search', '%' . $_GET['q'] . '%', PDO::PARAM_STR);
    $command->bindValue(':limit', intval($_GET['page_limit']), PDO::PARAM_INT);
    $command->bindValue(':start', intval(($_GET['page']-1)*10), PDO::PARAM_INT);
    $rows = $command->queryAll();
    $array = array();
    foreach ($rows as $c) {
        if (array_key_exists('format', $_GET)) {
            if ($_GET['format'] == 'select2') {
                $array[] = array(
                    'id' => $c['cliente_id'], 
                    'text' => "<strong>" . $c['cliente_nominativo'] . "</strong> (" . $c['cliente_nome'] . " " . $c['cliente_cognome'] . ")"
                );
            }
        } else {
            $array[] = $c;
        }
    }
    
    $json = new StdClass();
    $json->total = $total;
    $json->results = $array;
}

if ($_GET['s'] == 'client') {

    // get real results
    $sql = "SELECT *
            FROM {{clienti}} 
            WHERE cliente_id = :cliente_id";
    $command = Yii::app()->db->createCommand($sql);
    $command->bindValue(':cliente_id', intval($_GET['id']), PDO::PARAM_INT);
    $row = $command->queryRow();

    if (array_key_exists('format', $_GET)) {
        if ($_GET['format'] == 'select2') {
            $json = array(
                'id' => $row['cliente_id'], 
                'text' => "<strong>" . $row['cliente_nominativo'] . "</strong> (" . $row['cliente_nome'] . " " . $row['cliente_cognome'] . ")"
            );
        }
    } else {
        $json = $row;

        // get real results
        $elenco_nazioni = $blue->elenco_nazioni();
        $json['cliente_nazione_nome'] = $elenco_nazioni[$row['country']];

    }

}

if ($_GET['s'] == 'client_vectors') {
    // get real results
    $sql = "SELECT *
            FROM {{barche}} 
            WHERE barca_proprietario = :barca_proprietario
            ORDER BY barca_nome ASC";
    $command = Yii::app()->db->createCommand($sql);
    $command->bindValue(':barca_proprietario', $_GET['client'], PDO::PARAM_INT);
    $rows = $command->queryAll();
    $array = array();
    if (array_key_exists('first_null', $_GET)) {
        $array = array(array('id' => 0, 'text' => Yii::t('app', 'Not available or not needed')));
    }
    foreach ($rows as $c) {
        if (array_key_exists('format', $_GET)) {
            if ($_GET['format'] == 'select2') {
                $array[] = array(
                    'id' => $c['barca_id'], 
                    'text' => "<strong>" . $c['barca_nome'] . "</strong>"
                );
            }
        } else {
            $array[] = $c;
        }
    }
    
    $json = new StdClass();
    $json->results = $array;

}

if ($_GET['s'] == 'vector') {

    // get real results
    $sql = "SELECT *
            FROM {{barche}} 
            WHERE barca_id = :barca_id";
    $command = Yii::app()->db->createCommand($sql);
    $command->bindValue(':barca_id', intval($_GET['id']), PDO::PARAM_INT);
    $row = $command->queryRow();

    if (array_key_exists('format', $_GET)) {
        if ($_GET['format'] == 'select2') {
            $json = array(
                'id' => $row['barca_id'], 
                'text' => "<strong>" . $row['barca_nome'] . "</strong>",
            );
        }
    } else {
        $json = $row;
    }

}


if ($_GET['s'] == 'resources') {
    // get real results
    $sql = "SELECT posto_barca_id,pontile_codice,posto_barca_numero 
            FROM blue_posti_barca,blue_pontili 
            WHERE pontile_id = posto_barca_pontile AND posto_barca_dimensioni = :posto_barca_dimensioni 
            AND posto_barca_disponibile='1' ORDER BY posto_barca_pontile ASC, posto_barca_numero ASC";
    $command = Yii::app()->db->createCommand($sql);
    $command->bindValue(':posto_barca_dimensioni', $_GET['dimension'], PDO::PARAM_INT);
    $rows = $command->queryAll();
    $array = array();
    foreach ($rows as $row) {
        $r = array(
            'posto_barca_id' => $row['posto_barca_id'],
            'posto_barca'    => $row['pontile_codice'] . $row['posto_barca_numero'],
        );
        $array[] = $r;
    }
    $json = $array;
}

if ($_GET['s'] == 'resources_prices') {

    $anno_attuale = date('Y', time());
    $sql = "SELECT costo_giornaliero,costo_e1,costo_e2,costo_em,costo_es,costo_i1,costo_i2,costo_im,costo_is,costo_annuale 
            FROM blue_listini_posti_barca 
            WHERE listino_posto_barca_dimensione = :listino_posto_barca_dimensione 
            AND listino_posto_barca_anno = :anno";
    $command = Yii::app()->db->createCommand($sql);
    $command->bindValue(':listino_posto_barca_dimensione', $_GET['dimension'], PDO::PARAM_INT);
    $command->bindValue(':anno', $anno_attuale, PDO::PARAM_INT);
    $rows = $command->queryAll();
    $row = array_shift($rows);

    if (is_array($row)) {
        $row["costo_giornaliero"] = array('value' => $row["costo_giornaliero"], 'text' => "Giornaliero: " . $row['costo_giornaliero']);
        $row["costo_e1"] = array('value' => $row["costo_e1"], 'text' => "Alta stagione 1 settimana: " . $row['costo_e1']);
        $row["costo_e2"] = array('value' => $row["costo_e2"], 'text' => "Alta stagione 2 settimane: " . $row['costo_e2']);
        $row["costo_em"] = array('value' => $row["costo_em"], 'text' => "Alta stagione mensile: " . $row['costo_em']);
        $row["costo_es"] = array('value' => $row["costo_es"], 'text' => "Alta stagione stagionale: " . $row['costo_es']);
        $row["costo_i1"] = array('value' => $row["costo_i1"], 'text' => "Bassa stagione 1 settimana: " . $row['costo_i1']);
        $row["costo_i2"] = array('value' => $row["costo_i2"], 'text' => "Bassa stagione 2 settimane: " . $row['costo_i2']);
        $row["costo_im"] = array('value' => $row["costo_im"], 'text' => "Basta stagione mensile: " . $row['costo_im']);
        $row["costo_is"] = array('value' => $row["costo_is"], 'text' => "Basta stagione stagionale: " . $row['costo_is']);
        $row["costo_annuale"] = array('value' => $row["costo_annuale"], 'text' => "Annuale: " . $row['costo_annuale']);
    }

    $json['prices_current_year'] = $row;

    $anno_successivo = $anno_attuale + 1;
    $sql = "SELECT costo_giornaliero,costo_e1,costo_e2,costo_em,costo_es,costo_i1,costo_i2,costo_im,costo_is,costo_annuale 
            FROM blue_listini_posti_barca 
            WHERE listino_posto_barca_dimensione = :listino_posto_barca_dimensione 
            AND listino_posto_barca_anno = :anno";
    $command = Yii::app()->db->createCommand($sql);
    $command->bindValue(':listino_posto_barca_dimensione', $_GET['dimension'], PDO::PARAM_INT);
    $command->bindValue(':anno', $anno_successivo, PDO::PARAM_INT);
    $rows = $command->queryAll();
    $row = array_shift($rows);
    if (is_array($row)) {
        $row["costo_giornaliero"] = array('value' => $row["costo_giornaliero"], 'text' => "Giornaliero: " . $row['costo_giornaliero']);
        $row["costo_e1"] = array('value' => $row["costo_e1"], 'text' => "Alta stagione 1 settimana: " . $row['costo_e1']);
        $row["costo_e2"] = array('value' => $row["costo_e2"], 'text' => "Alta stagione 2 settimane: " . $row['costo_e2']);
        $row["costo_em"] = array('value' => $row["costo_em"], 'text' => "Alta stagione mensile: " . $row['costo_em']);
        $row["costo_es"] = array('value' => $row["costo_es"], 'text' => "Alta stagione stagionale: " . $row['costo_es']);
        $row["costo_i1"] = array('value' => $row["costo_i1"], 'text' => "Bassa stagione 1 settimana: " . $row['costo_i1']);
        $row["costo_i2"] = array('value' => $row["costo_i2"], 'text' => "Bassa stagione 2 settimane: " . $row['costo_i2']);
        $row["costo_im"] = array('value' => $row["costo_im"], 'text' => "Basta stagione mensile: " . $row['costo_im']);
        $row["costo_is"] = array('value' => $row["costo_is"], 'text' => "Basta stagione stagionale: " . $row['costo_is']);
        $row["costo_annuale"] = array('value' => $row["costo_annuale"], 'text' => "Annuale: " . $row['costo_annuale']);
    }

    $json['prices_next_year'] = $row;

}

if ($_GET['s'] == 'resource_status') {

    $pb = intval($_GET['resource']);
    
    $fine = strftime("%Y-%m-%d", time());
    if (array_key_exists('dal', $_GET)) {
        if (is_string($_GET['dal'])) {
            $fine = $_GET['dal'];
        }
    }
    
    $inizio = strftime("%Y-%m-%d", time());
    if (array_key_exists('al', $_GET)) {
        if (is_string($_GET['al'])) {
            $inizio = $_GET['al'];
        }
    }

    $res = $sql->select_query("SELECT posto_barca_proprietario,posto_barca_proprietario_data,posto_barca_gestore,posto_barca_gestore_data,posto_barca_gestore_data_fine FROM blue_posti_barca WHERE posto_barca_id='".$pb."'");
    $prop_id = mysql_result($res,0,'posto_barca_proprietario');
    $proprietario_data = mysql_result($res,0,'posto_barca_proprietario_data');
    $prop=$sql->select_query("SELECT cliente_nominativo FROM blue_clienti WHERE cliente_id='".$prop_id."'");
    $proprietario=mysql_result($prop,0,'cliente_nominativo');
    $json['owner'] = Yii::t('app', 'Owner') . ": <strong>" . $proprietario . "</strong> " . Yii::t('app', 'From') . " <strong>" . Yii::app()->format->formatDate($proprietario_data) . "</strong>";

    $gest_dal = mysql_result($res, 0, 'posto_barca_gestore_data');
    $gest_al = mysql_result($res, 0, 'posto_barca_gestore_data_fine');
    $gest_id = mysql_result($res, 0, 'posto_barca_gestore');
    $gest = $sql->select_query("SELECT cliente_nominativo FROM blue_clienti WHERE cliente_id='".$gest_id."'");
    $gestore=mysql_result($gest, 0, 'cliente_nominativo');

    $json['manager'] = Yii::t('app', 'Manager') . ": <strong>" . $gestore . "</strong> " . Yii::t('app', 'From') . " <strong>" . Yii::app()->format->formatDate($gest_dal) . "</strong> ";
    if ($gest_al != '0000-00-00') {
        $json['manager'].= Yii::t('app', 'To')  . " <strong>" . Yii::app()->format->formatDate($gest_al) . "</strong>";
    }
    
    $query = "SELECT contratto_id,contratto_anagrafica2,contratto_inizio,contratto_fine,contratto_tipo FROM blue_contratti WHERE contratto_posto_barca='".$pb."' AND (contratto_tipo=1 OR contratto_tipo=4 OR contratto_tipo=11) AND (contratto_inizio<='".$fine."' AND contratto_fine>='".$inizio."')";
    $res=$sql->select_query($query);
    $contratti='';
    while ($r = mysql_fetch_array($res)) {
        $dal = $r['contratto_inizio'];
        $al = $r['contratto_fine'];
        $rescli = $sql->select_query("SELECT cliente_nominativo FROM blue_clienti WHERE cliente_id='".$r['contratto_anagrafica2']."'");
        $cli = mysql_result($rescli,0,'cliente_nominativo');
        $contratti.= Yii::t('app', 'Current contract') . ' <a href="riepilogo.php?id=' . $r['contratto_id'] . '">' . $cli . '</a> (' . Yii::app()->format->formatDate($dal) . " - " . Yii::app()->format->formatDate($al) . ")";
    }

    $json['contract'] = $contratti;

}

if ($_GET['s'] == 'products') {

    // get results count
    $criteria = new CDbCriteria;
    $criteria->compare('sku', $_GET['q'], true, 'OR');
    $criteria->compare('name', $_GET['q'], true, 'OR');
    require_once "app/protected/modules/admin/models/Product.php";
    $total = Product::model()->count($criteria);

    $criteria->limit = intval($_GET['page_limit']);
    $criteria->offset = intval(($_GET['page']-1)*$criteria->limit);
    $rows = Product::model()->findAll($criteria);

    $array = array();
    foreach ($rows as $c) {
        if (array_key_exists('format', $_GET)) {
            if ($_GET['format'] == 'select2') {
                $array[] = array(
                    'id' => $c->id, 
                    'text' => "<strong>" . $c->sku . "</strong> " . $c->name,
                );
            }
        } else {
            $array[] = $c;
        }
    }
    
    $json = new StdClass();
    $json->total = $total;
    $json->results = $array;
}

if ($_GET['s'] == 'product') {

    require_once "app/protected/modules/admin/models/Product.php";
    $row = Product::model()->findByPk(intval($_GET['id']));

    if (array_key_exists('format', $_GET)) {
        if ($_GET['format'] == 'select2') {
            $json = array(
                'id' => $row->id, 
                'text' => "<strong>" . $row->sku . "</strong> " . $row->name,
            );
        }
    } else {
        $json = $row;
    }

}

if ($_GET['s'] == 'productDetail') {

    require_once "app/protected/modules/admin/models/Product.php";
    $row = Product::model()->findByPk(intval($_GET['id']));
    $json = $row->attributes;
    
}

if ($_GET['s'] == 'builder') {

    require_once "app/protected/modules/admin/models/Vector.php";
    $models = Vector::model()->findAll(array(
        'select'=>'builder',
        'distinct'=>true,
        'condition' => "builder LIKE '%" . $_GET['term'] . "%'",
    ));
    foreach ($models as $model) {
        $json[] = $model->builder;
    }
    
}

if ($_GET['s'] == 'insuranceCompany') {

    require_once "app/protected/modules/admin/models/Vector.php";
    $models = Vector::model()->findAll(array(
        'select'=>'insurance_company',
        'distinct'=>true,
        'condition' => "insurance_company LIKE '%" . $_GET['term'] . "%'",
    ));
    foreach ($models as $model) {
        $json[] = $model->insurance_company;
    }

}



if ($_GET['s'] == null) {
    $json = array('error' => 'You should pass at least one parameter: "s" with the name of the service you want to use');
}

header("Content-type: application/json");
echo json_encode($json);
Yii::app()->end();
