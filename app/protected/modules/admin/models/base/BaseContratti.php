<?php

/**
 * This is the model class for table "{{contratti}}".
 *
 * The followings are the available columns in table '{{contratti}}':
 * @property string $contratto_id
 * @property integer $contratto_anagrafica1
 * @property integer $contratto_anagrafica2
 * @property integer $contratto_tipo
 * @property integer $contratto_barca
 * @property integer $contratto_posto_barca
 * @property integer $contratto_periodo
 * @property string $contratto_data
 * @property string $contratto_inizio
 * @property string $contratto_fine
 * @property string $contratto_numero
 * @property integer $contratto_gestione_tipo
 * @property double $contratto_gestione_percentuale
 * @property string $contratto_note
 * @property string $contratto_imponibile
 * @property string $contratto_totale
 * @property string $contratto_fatturato
 * @property integer $contratto_fatturato_chiuso
 * @property double $contratto_sconto
 * @property string $contratto_ordine
 *
 * The followings are the available model relations:
 * @property OrderDetail[] $orderDetails
 */
class BaseContratti extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{contratti}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('contratto_note', 'required'),
			array('contratto_anagrafica1, contratto_anagrafica2, contratto_tipo, contratto_barca, contratto_posto_barca, contratto_periodo, contratto_gestione_tipo, contratto_fatturato_chiuso', 'numerical', 'integerOnly'=>true),
			array('contratto_gestione_percentuale, contratto_sconto', 'numerical'),
			array('contratto_numero', 'length', 'max'=>20),
			array('contratto_imponibile, contratto_totale, contratto_fatturato', 'length', 'max'=>10),
			array('contratto_data, contratto_inizio, contratto_fine, contratto_ordine', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('contratto_id, contratto_anagrafica1, contratto_anagrafica2, contratto_tipo, contratto_barca, contratto_posto_barca, contratto_periodo, contratto_data, contratto_inizio, contratto_fine, contratto_numero, contratto_gestione_tipo, contratto_gestione_percentuale, contratto_note, contratto_imponibile, contratto_totale, contratto_fatturato, contratto_fatturato_chiuso, contratto_sconto, contratto_ordine', 'safe', 'on'=>'search'),
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
			'orderDetails' => array(self::HAS_MANY, 'OrderDetail', 'contract_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'contratto_id' => Yii::t('app', 'Contratto'),
			'contratto_anagrafica1' => Yii::t('app', 'Contratto Anagrafica1'),
			'contratto_anagrafica2' => Yii::t('app', 'Contratto Anagrafica2'),
			'contratto_tipo' => Yii::t('app', 'Contratto Tipo'),
			'contratto_barca' => Yii::t('app', 'Contratto Barca'),
			'contratto_posto_barca' => Yii::t('app', 'Contratto Posto Barca'),
			'contratto_periodo' => Yii::t('app', 'Contratto Periodo'),
			'contratto_data' => Yii::t('app', 'Contratto Data'),
			'contratto_inizio' => Yii::t('app', 'Contratto Inizio'),
			'contratto_fine' => Yii::t('app', 'Contratto Fine'),
			'contratto_numero' => Yii::t('app', 'Contratto Numero'),
			'contratto_gestione_tipo' => Yii::t('app', 'Contratto Gestione Tipo'),
			'contratto_gestione_percentuale' => Yii::t('app', 'Contratto Gestione Percentuale'),
			'contratto_note' => Yii::t('app', 'Contratto Note'),
			'contratto_imponibile' => Yii::t('app', 'Contratto Imponibile'),
			'contratto_totale' => Yii::t('app', 'Contratto Totale'),
			'contratto_fatturato' => Yii::t('app', 'Contratto Fatturato'),
			'contratto_fatturato_chiuso' => Yii::t('app', 'Contratto Fatturato Chiuso'),
			'contratto_sconto' => Yii::t('app', 'Contratto Sconto'),
			'contratto_ordine' => Yii::t('app', 'Contratto Ordine'),
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

		$criteria->compare('contratto_id',$this->contratto_id,true);
		$criteria->compare('contratto_anagrafica1',$this->contratto_anagrafica1);
		$criteria->compare('contratto_anagrafica2',$this->contratto_anagrafica2);
		$criteria->compare('contratto_tipo',$this->contratto_tipo);
		$criteria->compare('contratto_barca',$this->contratto_barca);
		$criteria->compare('contratto_posto_barca',$this->contratto_posto_barca);
		$criteria->compare('contratto_periodo',$this->contratto_periodo);
		$criteria->compare('contratto_data',$this->contratto_data,true);
		$criteria->compare('contratto_inizio',$this->contratto_inizio,true);
		$criteria->compare('contratto_fine',$this->contratto_fine,true);
		$criteria->compare('contratto_numero',$this->contratto_numero,true);
		$criteria->compare('contratto_gestione_tipo',$this->contratto_gestione_tipo);
		$criteria->compare('contratto_gestione_percentuale',$this->contratto_gestione_percentuale);
		$criteria->compare('contratto_note',$this->contratto_note,true);
		$criteria->compare('contratto_imponibile',$this->contratto_imponibile,true);
		$criteria->compare('contratto_totale',$this->contratto_totale,true);
		$criteria->compare('contratto_fatturato',$this->contratto_fatturato,true);
		$criteria->compare('contratto_fatturato_chiuso',$this->contratto_fatturato_chiuso);
		$criteria->compare('contratto_sconto',$this->contratto_sconto);
		$criteria->compare('contratto_ordine',$this->contratto_ordine,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Contratti the static model class
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
