<?php

/**
 * This is the model class for table "{{order_detail}}".
 *
 * The followings are the available columns in table '{{order_detail}}':
 * @property string $id
 * @property string $order_id
 * @property string $product_id
 * @property string $contract_id
 * @property string $price
 * @property string $quantity
 * @property string $total_no_vat
 * @property string $vat
 * @property string $vat_value
 * @property string $total_vat
 * @property string $discount
 * @property string $discount_value
 * @property string $total
 * @property string $work_time
 * @property string $total_work_time
 * @property integer $done
 * @property string $notes
 * @property string $create_time
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property InvoiceRow[] $invoiceRows
 * @property Contratti $contract
 * @property Order $order
 * @property Product $product
 */
class BaseOrderDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{order_detail}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id', 'required'),
			array('done', 'numerical', 'integerOnly'=>true),
			array('order_id, product_id, contract_id', 'length', 'max'=>11),
			array('price, quantity, total_no_vat, vat, vat_value, total_vat, discount, discount_value, total, work_time, total_work_time', 'length', 'max'=>10),
			array('notes, create_time, update_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, order_id, product_id, contract_id, price, quantity, total_no_vat, vat, vat_value, total_vat, discount, discount_value, total, work_time, total_work_time, done, notes, create_time, update_time', 'safe', 'on'=>'search'),
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
			'invoiceRows' => array(self::HAS_MANY, 'InvoiceRow', 'order_detail_id'),
			'contract' => array(self::BELONGS_TO, 'Contratti', 'contract_id'),
			'order' => array(self::BELONGS_TO, 'Order', 'order_id'),
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app', 'ID'),
			'order_id' => Yii::t('app', 'Order'),
			'product_id' => Yii::t('app', 'Product'),
			'contract_id' => Yii::t('app', 'Contract'),
			'price' => Yii::t('app', 'Price'),
			'quantity' => Yii::t('app', 'Quantity'),
			'total_no_vat' => Yii::t('app', 'Total No Vat'),
			'vat' => Yii::t('app', 'Vat'),
			'vat_value' => Yii::t('app', 'Vat Value'),
			'total_vat' => Yii::t('app', 'Total Vat'),
			'discount' => Yii::t('app', 'Discount'),
			'discount_value' => Yii::t('app', 'Discount Value'),
			'total' => Yii::t('app', 'Total'),
			'work_time' => Yii::t('app', 'Work Time'),
			'total_work_time' => Yii::t('app', 'Total Work Time'),
			'done' => Yii::t('app', 'Done'),
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
		$criteria->compare('order_id',$this->order_id,true);
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('contract_id',$this->contract_id,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('quantity',$this->quantity,true);
		$criteria->compare('total_no_vat',$this->total_no_vat,true);
		$criteria->compare('vat',$this->vat,true);
		$criteria->compare('vat_value',$this->vat_value,true);
		$criteria->compare('total_vat',$this->total_vat,true);
		$criteria->compare('discount',$this->discount,true);
		$criteria->compare('discount_value',$this->discount_value,true);
		$criteria->compare('total',$this->total,true);
		$criteria->compare('work_time',$this->work_time,true);
		$criteria->compare('total_work_time',$this->total_work_time,true);
		$criteria->compare('done',$this->done);
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
	 * @return OrderDetail the static model class
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
