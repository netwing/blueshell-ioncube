<?php

/**
 * This is the model class for table "{{invoice_type}}".
 *
 * The followings are the available columns in table '{{invoice_type}}':
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $color
 * @property string $type
 * @property string $prefix
 * @property integer $year_restart
 * @property string $sort_order
 * @property integer $enabled
 * @property string $create_time
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property Invoice[] $invoices
 */
class BaseInvoiceType extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{invoice_type}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('year_restart, enabled', 'numerical', 'integerOnly'=>true),
			array('name, color, prefix', 'length', 'max'=>255),
			array('type', 'length', 'max'=>7),
			array('sort_order', 'length', 'max'=>11),
			array('description, create_time, update_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, description, color, type, prefix, year_restart, sort_order, enabled, create_time, update_time', 'safe', 'on'=>'search'),
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
			'invoices' => array(self::HAS_MANY, 'Invoice', 'type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app', 'ID'),
			'name' => Yii::t('app', 'Name'),
			'description' => Yii::t('app', 'Description'),
			'color' => Yii::t('app', 'Color'),
			'type' => Yii::t('app', 'Type'),
			'prefix' => Yii::t('app', 'Prefix'),
			'year_restart' => Yii::t('app', 'Year Restart'),
			'sort_order' => Yii::t('app', 'Sort Order'),
			'enabled' => Yii::t('app', 'Enabled'),
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('prefix',$this->prefix,true);
		$criteria->compare('year_restart',$this->year_restart);
		$criteria->compare('sort_order',$this->sort_order,true);
		$criteria->compare('enabled',$this->enabled);
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
	 * @return InvoiceType the static model class
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
