<?php

/**
 * This is the model class for table "{{barche}}".
 *
 * The followings are the available columns in table '{{barche}}':
 * @property string $barca_id
 * @property string $barca_nome
 * @property integer $barca_tipologia_barca
 * @property integer $barca_nazione
 * @property integer $barca_costruttore
 * @property string $barca_modello
 * @property string $barca_anno
 * @property double $barca_lunghezza
 * @property double $barca_larghezza
 * @property double $barca_pescaggio
 * @property string $barca_motore
 * @property string $barca_matricola_motore1
 * @property string $barca_matricola_motore2
 * @property string $barca_targa
 * @property integer $barca_assicurazione
 * @property string $barca_polizza
 * @property string $barca_scadenza_polizza
 * @property string $barca_caratteristiche
 * @property string $barca_colore
 * @property string $barca_proprietario
 * @property string $barca_note
 * @property string $builder
 * @property string $insurance_company
 * @property string $country
 * @property string $create_time
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property Order[] $orders
 */
class BaseVector extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{barche}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('create_time', 'required'),
			array('barca_tipologia_barca, barca_nazione, barca_costruttore, barca_assicurazione', 'numerical', 'integerOnly'=>true),
			array('barca_lunghezza, barca_larghezza, barca_pescaggio', 'numerical'),
			array('barca_nome', 'length', 'max'=>150),
			array('barca_modello', 'length', 'max'=>100),
			array('barca_anno, barca_proprietario', 'length', 'max'=>10),
			array('barca_motore, barca_colore', 'length', 'max'=>50),
			array('barca_matricola_motore1, barca_matricola_motore2, barca_targa, barca_polizza', 'length', 'max'=>20),
			array('builder, insurance_company, country', 'length', 'max'=>255),
			array('barca_scadenza_polizza, barca_caratteristiche, barca_note, update_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('barca_id, barca_nome, barca_tipologia_barca, barca_nazione, barca_costruttore, barca_modello, barca_anno, barca_lunghezza, barca_larghezza, barca_pescaggio, barca_motore, barca_matricola_motore1, barca_matricola_motore2, barca_targa, barca_assicurazione, barca_polizza, barca_scadenza_polizza, barca_caratteristiche, barca_colore, barca_proprietario, barca_note, builder, insurance_company, country, create_time, update_time', 'safe', 'on'=>'search'),
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
			'orders' => array(self::HAS_MANY, 'Order', 'vector_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'barca_id' => Yii::t('app', 'Barca'),
			'barca_nome' => Yii::t('app', 'Barca Nome'),
			'barca_tipologia_barca' => Yii::t('app', 'Barca Tipologia Barca'),
			'barca_nazione' => Yii::t('app', 'Barca Nazione'),
			'barca_costruttore' => Yii::t('app', 'Barca Costruttore'),
			'barca_modello' => Yii::t('app', 'Barca Modello'),
			'barca_anno' => Yii::t('app', 'Barca Anno'),
			'barca_lunghezza' => Yii::t('app', 'Barca Lunghezza'),
			'barca_larghezza' => Yii::t('app', 'Barca Larghezza'),
			'barca_pescaggio' => Yii::t('app', 'Barca Pescaggio'),
			'barca_motore' => Yii::t('app', 'Barca Motore'),
			'barca_matricola_motore1' => Yii::t('app', 'Barca Matricola Motore1'),
			'barca_matricola_motore2' => Yii::t('app', 'Barca Matricola Motore2'),
			'barca_targa' => Yii::t('app', 'Barca Targa'),
			'barca_assicurazione' => Yii::t('app', 'Barca Assicurazione'),
			'barca_polizza' => Yii::t('app', 'Barca Polizza'),
			'barca_scadenza_polizza' => Yii::t('app', 'Barca Scadenza Polizza'),
			'barca_caratteristiche' => Yii::t('app', 'Barca Caratteristiche'),
			'barca_colore' => Yii::t('app', 'Barca Colore'),
			'barca_proprietario' => Yii::t('app', 'Barca Proprietario'),
			'barca_note' => Yii::t('app', 'Barca Note'),
			'builder' => Yii::t('app', 'Builder'),
			'insurance_company' => Yii::t('app', 'Insurance Company'),
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

		$criteria->compare('barca_id',$this->barca_id,true);
		$criteria->compare('barca_nome',$this->barca_nome,true);
		$criteria->compare('barca_tipologia_barca',$this->barca_tipologia_barca);
		$criteria->compare('barca_nazione',$this->barca_nazione);
		$criteria->compare('barca_costruttore',$this->barca_costruttore);
		$criteria->compare('barca_modello',$this->barca_modello,true);
		$criteria->compare('barca_anno',$this->barca_anno,true);
		$criteria->compare('barca_lunghezza',$this->barca_lunghezza);
		$criteria->compare('barca_larghezza',$this->barca_larghezza);
		$criteria->compare('barca_pescaggio',$this->barca_pescaggio);
		$criteria->compare('barca_motore',$this->barca_motore,true);
		$criteria->compare('barca_matricola_motore1',$this->barca_matricola_motore1,true);
		$criteria->compare('barca_matricola_motore2',$this->barca_matricola_motore2,true);
		$criteria->compare('barca_targa',$this->barca_targa,true);
		$criteria->compare('barca_assicurazione',$this->barca_assicurazione);
		$criteria->compare('barca_polizza',$this->barca_polizza,true);
		$criteria->compare('barca_scadenza_polizza',$this->barca_scadenza_polizza,true);
		$criteria->compare('barca_caratteristiche',$this->barca_caratteristiche,true);
		$criteria->compare('barca_colore',$this->barca_colore,true);
		$criteria->compare('barca_proprietario',$this->barca_proprietario,true);
		$criteria->compare('barca_note',$this->barca_note,true);
		$criteria->compare('builder',$this->builder,true);
		$criteria->compare('insurance_company',$this->insurance_company,true);
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
	 * @return Vector the static model class
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
