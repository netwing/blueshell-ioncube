<?php

Yii::import('ext.EConsoleCommand.EConsoleCommand');

class importCommand extends EConsoleCommand
{
    private $db = null;

    private $countries = null;

    private $country_codes = null;

    public function init()
    {
        parent::init();

        $data = require(APPLICATION_PATH . "/../../vendor/yiisoft/yii/framework/i18n/data/it_it.php");
        foreach ($data['territories'] as $k => $v) {
            if (is_numeric($k)) {
                unset($data['territories'][$k]);
            }
        }
        $this->countries = $data['territories'];
        $this->country_codes = array_flip($data['territories']);
    }

    protected function beforeAction($action, $params)
    {
        $result = parent::beforeAction($action, $params);
        
        $this->printlnColor("********************************************************************************", self::FGB_WHITE);
        $this->printlnColor("*                                                                              *", self::FGB_WHITE);
        $this->printlnColor("*                         BLUESHELL 1 TO 2 IMPORT TOOL                         *", self::FGB_WHITE);
        $this->printlnColor("*                                                                              *", self::FGB_WHITE);
        $this->printlnColor("********************************************************************************", self::FGB_WHITE);        
        $this->printlnColor("", self::FGB_WHITE);        

        return $result;
    }

    protected function afterAction($action, $params, $exitCode = 0)
    {
        $result = parent::afterAction($action, $params, $exitCode = 0);

        $this->printlnColor("********************************************************************************", self::FGB_WHITE);
        $this->printlnColor("", self::FGB_WHITE);

        return $result;
    }

    public function actionIndex()
    {

        // Adjust countries
        $result = $this->_countries();
        if ($result === false) {
            return false;
        }

        // Adjust vector
        $result = $this->_vectors();
        if ($result === false) {
            return false;
        }

        // Adjust customer
        $result = $this->_customers();
        if ($result === false) {
            return false;
        }

        Yii::app()->redis->FLUSHDB();

    }

    private function _countries()
    {
        $this->printlnColor("Countries reset");

        $command = Yii::app()->db->createCommand("SELECT * FROM {{nazioni}}");
        $result = $command->query();

        $reset = array(
            "Abu Dhabi" => "Emirati Arabi Uniti",
            "Ajman" => "Emirati Arabi Uniti",
            "American Samoa" => "Samoa Americane",
            "Antigua E Barbuda" => "Antigua e Barbuda",
            "Ascension" => "Regno Unito",
            "Azzorre, Isole" => "Portogallo",
            "Bahama" => "Bahamas",
            "Belgio (compreso Lussemburgo)" => "Belgio",
            "Campione D'italia" => "Italia",
            "Canarie, Isole" => "Spagna",
            "Caroline, Isole" => "Micronesia",
            "Cayman Islands" => "Isole Cayman",
            "Cecoslovacchia" => "Repubblica Ceca",
            "Centroafricana Rep." => "Repubblica Centrafricana",
            "Ceuta" => "Spagna",
            "Chafarinas" => "Spagna",
            "Chagos, Isole" => "Regno Unito",
            "Cina Rep.pop." => "Cina",
            "Citta' Del Vaticano" => "Vaticano",
            "Clipperton" => "Francia",
            "Cook, Isole" => "Isole Cook",
            "Corea Del Nord" => "Corea del Nord",
            "Corea Del Sud" => "Corea del Sud",
            "Costa D'avorio" => 'Costa d\'Avorio',
            "Costarica" => "Costa Rica",
            "Dominicana Rep." => "Repubblica Dominicana",
            "Dubai" => "Emirati Arabi Uniti",
            "Falkland" => "Isole Falkland [isole Malvine]",
            "Far Oer, Isole" => "Isole Faroe",
            "Fiji" => "Figi",
            "Fuijayrah" => "Emirati Arabi Uniti",
            "Germania (unita Ex Germania Federale)" => "Germania",
            "Gough" => "Regno Unito",
            "Guayana Francese" => "Guyana",
            "Guinea Bissau" => "Guinea-Bissau",
            "Hong Kong" => "Hong-Kong",
            "Isole Americane Del Pacifico" => "Isole Minori lontane dagli Stati Uniti",
            "Italia (compreso San Marino)" => "Italia",
            "Jugoslavia" => "Serbia",
            "Kampuchea" => "Cambogia",
            "Macao" => "Regione Amministrativa Speciale di Macao della Repubblica Popolare Cinese",
            "Madeira" => "Portogallo",
            "Malaysia" => "Malesia",
            "Man, Isola" => "Isola di Man",
            "Marianne Settentrionali, Isole" => "Isole Marianne Settentrionali",
            "Marshall, Isole" => "Isole Marshall",
            "Maurizio" => "Mauritius",
            "Melilla" => "Spagna",
            "Micronesia, Stati Federali" => "Micronesia",
            "Midway" => "Stati Uniti",
            "Olanda" => "Paesi Bassi",
            "Paesi Non Classificabili" => "Regione non valida o sconosciuta",
            "Panama - Zona Del Canale" => "Panama",
            "Papua - Nuova Guinea" => "Papua Nuova Guinea",
            "Penon De Alhucemas" => "Spagna",
            "Penon De Velez De La Gomera" => "Spagna",
            "Peru'" => "Perù",
            "Principato Di Monaco" => "Monaco",
            "Ras El Khaimah" => "Emirati Arabi Uniti",
            "Reunion" => "Francia",
            "Russia" => "Federazione Russa",
            "Rwanda" => "Ruanda",
            "Saint Martin Settentrionale" => "Francia",
            "Salomone, Isole" => "Isole Solomon",
            "Sant'elena" => "Sant’Elena",
            "Sao Tome E Principe" => "Sao Tomé e Príncipe",
            "Sharjah" => "Emirati Arabi Uniti",
            "St Pierre E Miquelon" => "Saint Pierre e Miquelon",
            "St. Kitts E Nevis" => "Saint Kitts e Nevis",
            "St. Vincent E Grenadine" => "Saint Vincent e Grenadines",
            "Stati Uniti" => "Stati Uniti",
            "Sudafricana Rep." => "Sudafrica",
            "Territorio Antartico Britannico" => "Antartide",
            "Territorio Antartico Francese" => "Antartide",
            "Territorio Britannico Oceano Indiano" => "Territorio Britannico dell’Oceano Indiano",
            "Thailandia" => "Tailandia",
            "Trinidad E Tobago" => "Trinidad e Tobago",
            "Tristan Da Cunha" => "Regno Unito",
            "Turks E Caicos" => "Regno Unito",
            "Tuvalu'" => "Tuvalu",
            "Umm Al Qaiwain" => "Emirati Arabi Uniti",
            "Vergini Americane, Isole" => "Isole Vergini Americane",
            "Vergini Britanniche, Isole" => "Isole Vergini Britanniche",
            "Wake" => "Stati Uniti",
            "Wallis E Futuna" => "Wallis e Futuna",
            "Zaire" => "Congo - RDC",
            "Congo" => "Repubblica del Congo",
            "Virginia" => "Stati Uniti",
            "Usa" => "Stati Uniti",
            "Gran Bretagna" => "Regno Unito",
            "California" => "Stati Uniti",
            "Inghilterra" => "Regno Unito",
            "British Virgin Islands" => "Isole Vergini Britanniche",
            "England" => "Regno Unito",
            "Channel Islands , Gy1 4hh" => "Jersey",
            "Cornwall" => "Regno Unito",
            "U.s.a." => "Stati Uniti",
            "Texas - Usa" => "Stati Uniti",
            "Non Disponibile" => "Regione non valida o sconosciuta",
            "Stati Uniti D'america" => "Stati Uniti",
        );

        $i = 0;
        foreach ($result as $row) {
            if (in_array($row['nazione_nome'], $this->countries)) {
                Yii::app()->redis->SET("BS:1:2:country:" . $row['nazione_nome'], $row['nazione_nome']);
                Yii::app()->redis->SET("BS:1:2:country:" . $row['nazione_id'], $row['nazione_nome']);
            } else {
                if (array_key_exists($row['nazione_nome'], $reset)) {
                    if (in_array($reset[$row['nazione_nome']], $this->countries)) {
                        try {
                            $this->printlnColor("\t" . $row['nazione_nome'] . " => " . $reset[$row['nazione_nome']]);
                            Yii::app()->redis->SET("BS:1:2:country:" . $row['nazione_nome'], $reset[$row['nazione_nome']]);
                            Yii::app()->redis->SET("BS:1:2:country:" . $row['nazione_id'], $reset[$row['nazione_nome']]);
                        } catch (Exception $e) {
                            $this->printlnError("");
                            $this->printlnError($e->getMessage());
                        }
                    } else {
                        $this->printlnError("La nazione " . $row['nazione_nome'] . " non ha una corrispondenza");
                        CVarDumper::dump($this->countries);
                        return false;
                    }
                } else {
                    $this->printlnNotice("Non trovo " . $row['nazione_nome'] . " nell'array di corrispondenza");
                    CVarDumper::dump($this->countries);
                    return false;
                }
            }
        }

        $this->printlnSuccess("\tDone.");
        return true;
    }

    private function _customers()
    {
        $this->printlnColor("Import customers");

        $i = 0;
        foreach (Customer::model()->findAll() as $c) {

            $nazione = Yii::app()->redis->GET('BS:1:2:country:' . $c->cliente_nazione);
            if (array_key_exists($nazione, $this->country_codes)) {
                $country = $this->country_codes[Yii::app()->redis->GET('BS:1:2:country:' . $c->cliente_nazione)];
            } else {
                $country = "zz";
            }
            $c->country = $country;
            $c->create_time = new CDbExpression('NOW()');
            $result = $c->save();
            if ($result === false) {
                return false;
            }
            $this->printColor(".");
            $i++;

        }
        $this->printlnColor("");
        $this->printlnSuccess("\tDone with " . $i . " imported customers");
        return true;
    }

    private function _vectors()
    {
        $this->printlnColor("Import vectors");

        $i = 0;
        foreach (Vector::model()->findAll() as $row) {

            if ($row->exBuilder) {
                $row->builder = $row->exBuilder->costruttore_nome;
            }
            if ($row->exInsuranceCompany) {
                $row->insurance_company = $row->exInsuranceCompany->assicurazione_nome;
            }

            $nazione = Yii::app()->redis->GET('BS:1:2:country:' . $row->barca_nazione);
            if (array_key_exists($nazione, $this->country_codes)) {
                $country = $this->country_codes[Yii::app()->redis->GET('BS:1:2:country:' . $row->barca_nazione)];
            } else {
                $country = "zz";
            }
            $row->country = $country;
            $row->create_time = new CDbExpression('NOW()');
            $result = $row->save();
            if ($result === false) {
                return false;
            }
            $this->printColor(".");
            $i++;

        }
        $this->printlnColor("");
        $this->printlnSuccess("\tDone with " . $i . " imported vectors");
        return true;
    }

}
