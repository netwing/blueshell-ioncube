<?php

/**
 * This is the model class for table "{{presenze}}".
 *
 * The followings are the available columns in table '{{presenze}}':
 * @property string $presenza_id
 * @property integer $presenza_posto_barca
 * @property integer $presenza_cliente
 * @property integer $presenza_barca
 * @property string $presenza_arrivo
 * @property string $presenza_partenza
 */
class BasePresence extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{presenze}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('presenza_posto_barca, presenza_cliente, presenza_barca', 'numerical', 'integerOnly'=>true),
			array('presenza_arrivo, presenza_partenza', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('presenza_id, presenza_posto_barca, presenza_cliente, presenza_barca, presenza_arrivo, presenza_partenza', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'presenza_id' => Yii::t('app', 'Presenza'),
			'presenza_posto_barca' => Yii::t('app', 'Presenza Posto Barca'),
			'presenza_cliente' => Yii::t('app', 'Presenza Cliente'),
			'presenza_barca' => Yii::t('app', 'Presenza Barca'),
			'presenza_arrivo' => Yii::t('app', 'Presenza Arrivo'),
			'presenza_partenza' => Yii::t('app', 'Presenza Partenza'),
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

		$criteria->compare('presenza_id',$this->presenza_id,true);
		$criteria->compare('presenza_posto_barca',$this->presenza_posto_barca);
		$criteria->compare('presenza_cliente',$this->presenza_cliente);
		$criteria->compare('presenza_barca',$this->presenza_barca);
		$criteria->compare('presenza_arrivo',$this->presenza_arrivo,true);
		$criteria->compare('presenza_partenza',$this->presenza_partenza,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Presence the static model class
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
