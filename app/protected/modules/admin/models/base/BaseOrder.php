<?php

/**
 * This is the model class for table "{{order}}".
 *
 * The followings are the available columns in table '{{order}}':
 * @property string $id
 * @property string $customer_id
 * @property string $vector_id
 * @property string $date
 * @property string $work_date
 * @property string $due_date
 * @property string $work_number
 * @property string $type_id
 * @property string $status_id
 * @property string $notes
 * @property string $create_time
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property OrderType $type
 * @property Clienti $customer
 * @property OrderStatus $status
 * @property Barche $vector
 * @property OrderDetail[] $orderDetails
 */
class BaseOrder extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{order}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customer_id, date, status_id', 'required'),
			array('customer_id, vector_id', 'length', 'max'=>10),
			array('work_number, type_id, status_id', 'length', 'max'=>11),
			array('work_date, due_date, notes, create_time, update_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, customer_id, vector_id, date, work_date, due_date, work_number, type_id, status_id, notes, create_time, update_time', 'safe', 'on'=>'search'),
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
			'type' => array(self::BELONGS_TO, 'OrderType', 'type_id'),
			'customer' => array(self::BELONGS_TO, 'Clienti', 'customer_id'),
			'status' => array(self::BELONGS_TO, 'OrderStatus', 'status_id'),
			'vector' => array(self::BELONGS_TO, 'Barche', 'vector_id'),
			'orderDetails' => array(self::HAS_MANY, 'OrderDetail', 'order_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app', 'ID'),
			'customer_id' => Yii::t('app', 'Customer'),
			'vector_id' => Yii::t('app', 'Vector'),
			'date' => Yii::t('app', 'Date'),
			'work_date' => Yii::t('app', 'Work Date'),
			'due_date' => Yii::t('app', 'Due Date'),
			'work_number' => Yii::t('app', 'Work Number'),
			'type_id' => Yii::t('app', 'Type'),
			'status_id' => Yii::t('app', 'Status'),
			'notes' => Yii::t('app', 'Notes'),
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('customer_id',$this->customer_id,true);
		$criteria->compare('vector_id',$this->vector_id,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('work_date',$this->work_date,true);
		$criteria->compare('due_date',$this->due_date,true);
		$criteria->compare('work_number',$this->work_number,true);
		$criteria->compare('type_id',$this->type_id,true);
		$criteria->compare('status_id',$this->status_id,true);
		$criteria->compare('notes',$this->notes,true);
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
	 * @return Order the static model class
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
