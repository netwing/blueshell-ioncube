<?php

/**
 * This is the model class for table "{{clienti}}".
 *
 * The followings are the available columns in table '{{clienti}}':
 * @property string $cliente_id
 * @property string $cliente_nominativo
 * @property string $cliente_tipo
 * @property string $cliente_nome
 * @property string $cliente_cognome
 * @property string $cliente_data_nascita
 * @property string $cliente_luogo_nascita
 * @property string $cliente_indirizzo
 * @property string $cliente_citta
 * @property string $cliente_cap
 * @property string $cliente_provincia
 * @property integer $cliente_nazione
 * @property string $cliente_telefono1
 * @property string $cliente_tipo_telefono1
 * @property string $cliente_telefono2
 * @property string $cliente_tipo_telefono2
 * @property string $cliente_telefono3
 * @property string $cliente_tipo_telefono3
 * @property string $cliente_email
 * @property string $cliente_codice_fiscale
 * @property string $cliente_partita_iva
 * @property string $cliente_documento
 * @property string $cliente_numero_documento
 * @property integer $cliente_rifiuta_comunicazioni
 * @property string $cliente_note
 * @property string $data_inserimento_cliente
 * @property string $country
 * @property string $create_time
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property Invoice[] $invoices
 * @property Order[] $orders
 */
class BaseCustomer extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{clienti}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('data_inserimento_cliente', 'required'),
			array('cliente_nazione, cliente_rifiuta_comunicazioni', 'numerical', 'integerOnly'=>true),
			array('cliente_nominativo, cliente_indirizzo', 'length', 'max'=>250),
			array('cliente_tipo', 'length', 'max'=>17),
			array('cliente_nome, cliente_cognome, cliente_citta', 'length', 'max'=>50),
			array('cliente_luogo_nascita, cliente_email', 'length', 'max'=>150),
			array('cliente_cap', 'length', 'max'=>5),
			array('cliente_provincia', 'length', 'max'=>2),
			array('cliente_telefono1, cliente_telefono2, cliente_telefono3', 'length', 'max'=>30),
			array('cliente_tipo_telefono1, cliente_tipo_telefono2, cliente_tipo_telefono3', 'length', 'max'=>10),
			array('cliente_codice_fiscale, cliente_partita_iva, cliente_numero_documento', 'length', 'max'=>20),
			array('cliente_documento', 'length', 'max'=>15),
			array('country', 'length', 'max'=>255),
			array('cliente_data_nascita, cliente_note, create_time, update_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cliente_id, cliente_nominativo, cliente_tipo, cliente_nome, cliente_cognome, cliente_data_nascita, cliente_luogo_nascita, cliente_indirizzo, cliente_citta, cliente_cap, cliente_provincia, cliente_nazione, cliente_telefono1, cliente_tipo_telefono1, cliente_telefono2, cliente_tipo_telefono2, cliente_telefono3, cliente_tipo_telefono3, cliente_email, cliente_codice_fiscale, cliente_partita_iva, cliente_documento, cliente_numero_documento, cliente_rifiuta_comunicazioni, cliente_note, data_inserimento_cliente, country, create_time, update_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'invoices' => array(self::HAS_MANY, 'Invoice', 'customer_id'),
			'orders' => array(self::HAS_MANY, 'Order', 'customer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cliente_id' => Yii::t('app', 'Cliente'),
			'cliente_nominativo' => Yii::t('app', 'Cliente Nominativo'),
			'cliente_tipo' => Yii::t('app', 'Cliente Tipo'),
			'cliente_nome' => Yii::t('app', 'Cliente Nome'),
			'cliente_cognome' => Yii::t('app', 'Cliente Cognome'),
			'cliente_data_nascita' => Yii::t('app', 'Cliente Data Nascita'),
			'cliente_luogo_nascita' => Yii::t('app', 'Cliente Luogo Nascita'),
			'cliente_indirizzo' => Yii::t('app', 'Cliente Indirizzo'),
			'cliente_citta' => Yii::t('app', 'Cliente Citta'),
			'cliente_cap' => Yii::t('app', 'Cliente Cap'),
			'cliente_provincia' => Yii::t('app', 'Cliente Provincia'),
			'cliente_nazione' => Yii::t('app', 'Cliente Nazione'),
			'cliente_telefono1' => Yii::t('app', 'Cliente Telefono1'),
			'cliente_tipo_telefono1' => Yii::t('app', 'Cliente Tipo Telefono1'),
			'cliente_telefono2' => Yii::t('app', 'Cliente Telefono2'),
			'cliente_tipo_telefono2' => Yii::t('app', 'Cliente Tipo Telefono2'),
			'cliente_telefono3' => Yii::t('app', 'Cliente Telefono3'),
			'cliente_tipo_telefono3' => Yii::t('app', 'Cliente Tipo Telefono3'),
			'cliente_email' => Yii::t('app', 'Cliente Email'),
			'cliente_codice_fiscale' => Yii::t('app', 'Cliente Codice Fiscale'),
			'cliente_partita_iva' => Yii::t('app', 'Cliente Partita Iva'),
			'cliente_documento' => Yii::t('app', 'Cliente Documento'),
			'cliente_numero_documento' => Yii::t('app', 'Cliente Numero Documento'),
			'cliente_rifiuta_comunicazioni' => Yii::t('app', 'Cliente Rifiuta Comunicazioni'),
			'cliente_note' => Yii::t('app', 'Cliente Note'),
			'data_inserimento_cliente' => Yii::t('app', 'Data Inserimento Cliente'),
			'country' => Yii::t('app', 'Country'),
			'create_time' => Yii::t('app', 'Create Time'),
			'update_time' => Yii::t('app', 'Update Time'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('cliente_id',$this->cliente_id,true);
		$criteria->compare('cliente_nominativo',$this->cliente_nominativo,true);
		$criteria->compare('cliente_tipo',$this->cliente_tipo,true);
		$criteria->compare('cliente_nome',$this->cliente_nome,true);
		$criteria->compare('cliente_cognome',$this->cliente_cognome,true);
		$criteria->compare('cliente_data_nascita',$this->cliente_data_nascita,true);
		$criteria->compare('cliente_luogo_nascita',$this->cliente_luogo_nascita,true);
		$criteria->compare('cliente_indirizzo',$this->cliente_indirizzo,true);
		$criteria->compare('cliente_citta',$this->cliente_citta,true);
		$criteria->compare('cliente_cap',$this->cliente_cap,true);
		$criteria->compare('cliente_provincia',$this->cliente_provincia,true);
		$criteria->compare('cliente_nazione',$this->cliente_nazione);
		$criteria->compare('cliente_telefono1',$this->cliente_telefono1,true);
		$criteria->compare('cliente_tipo_telefono1',$this->cliente_tipo_telefono1,true);
		$criteria->compare('cliente_telefono2',$this->cliente_telefono2,true);
		$criteria->compare('cliente_tipo_telefono2',$this->cliente_tipo_telefono2,true);
		$criteria->compare('cliente_telefono3',$this->cliente_telefono3,true);
		$criteria->compare('cliente_tipo_telefono3',$this->cliente_tipo_telefono3,true);
		$criteria->compare('cliente_email',$this->cliente_email,true);
		$criteria->compare('cliente_codice_fiscale',$this->cliente_codice_fiscale,true);
		$criteria->compare('cliente_partita_iva',$this->cliente_partita_iva,true);
		$criteria->compare('cliente_documento',$this->cliente_documento,true);
		$criteria->compare('cliente_numero_documento',$this->cliente_numero_documento,true);
		$criteria->compare('cliente_rifiuta_comunicazioni',$this->cliente_rifiuta_comunicazioni);
		$criteria->compare('cliente_note',$this->cliente_note,true);
		$criteria->compare('data_inserimento_cliente',$this->data_inserimento_cliente,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Customer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * Behavior for timestamp
	 */
	public function behaviors(){
		return array(
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				// 'createAttribute' => 'create_time',
				// 'updateAttribute' => 'update_time',
			)
		);
	}

	/**
	 * Either attributes required (one or another)
	 * Use like this: 
	 * array('attributes1', 'either', 'other' => 'attributes2')
	 */ 
	public function either($attribute_name, $params)
	{
	    $field1 = $this->getAttributeLabel($attribute_name);
	    $field2 = $this->getAttributeLabel($params['other']);
	    if (empty($this->$attribute_name) && empty($this->$params['other'])) {
	        $this->addError(
	        	$attribute_name, 
	        	Yii::t('app', "Either {field1} or {field2} is required.", array('{field1}' => $field1, '{field2}' => $field2)));
	        return false;
	    }
	    return true;
	}	 
}
