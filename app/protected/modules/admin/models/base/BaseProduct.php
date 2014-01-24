<?php

/**
 * This is the model class for table "{{product}}".
 *
 * The followings are the available columns in table '{{product}}':
 * @property string $id
 * @property string $group_id
 * @property string $sku
 * @property string $name
 * @property string $description
 * @property string $measure_unit
 * @property string $price
 * @property string $vat
 * @property string $work_time
 * @property integer $enabled
 * @property string $sort_order
 * @property string $create_time
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property OrderDetail[] $orderDetails
 * @property ProductGroup $group
 */
class BaseProduct extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{product}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('group_id, sku, name, measure_unit', 'required'),
			array('enabled', 'numerical', 'integerOnly'=>true),
			array('group_id, sort_order', 'length', 'max'=>11),
			array('sku, name, measure_unit', 'length', 'max'=>255),
			array('price, vat, work_time', 'length', 'max'=>10),
			array('description, create_time, update_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, group_id, sku, name, description, measure_unit, price, vat, work_time, enabled, sort_order, create_time, update_time', 'safe', 'on'=>'search'),
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
			'orderDetails' => array(self::HAS_MANY, 'OrderDetail', 'product_id'),
			'group' => array(self::BELONGS_TO, 'ProductGroup', 'group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app', 'ID'),
			'group_id' => Yii::t('app', 'Group'),
			'sku' => Yii::t('app', 'Sku'),
			'name' => Yii::t('app', 'Name'),
			'description' => Yii::t('app', 'Description'),
			'measure_unit' => Yii::t('app', 'Measure Unit'),
			'price' => Yii::t('app', 'Price'),
			'vat' => Yii::t('app', 'Vat'),
			'work_time' => Yii::t('app', 'Work Time'),
			'enabled' => Yii::t('app', 'Enabled'),
			'sort_order' => Yii::t('app', 'Sort Order'),
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
		$criteria->compare('group_id',$this->group_id,true);
		$criteria->compare('sku',$this->sku,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('measure_unit',$this->measure_unit,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('vat',$this->vat,true);
		$criteria->compare('work_time',$this->work_time,true);
		$criteria->compare('enabled',$this->enabled);
		$criteria->compare('sort_order',$this->sort_order,true);
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
	 * @return Product the static model class
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
}
