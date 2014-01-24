<?php

/**
 * This is the model class for table "{{invoice_row}}".
 *
 * The followings are the available columns in table '{{invoice_row}}':
 * @property string $id
 * @property string $invoice_id
 * @property string $order_detail_id
 * @property string $description
 * @property string $price
 * @property string $quantity
 * @property string $total_no_vat
 * @property string $vat
 * @property string $vat_value
 * @property string $total_vat
 * @property string $discount
 * @property string $discount_value
 * @property string $total
 * @property string $notes
 * @property string $create_time
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property Invoice $invoice
 * @property OrderDetail $orderDetail
 */
class BaseInvoiceRow extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{invoice_row}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('invoice_id, description', 'required'),
			array('invoice_id, order_detail_id', 'length', 'max'=>11),
			array('price, quantity, total_no_vat, vat, vat_value, total_vat, discount, discount_value, total', 'length', 'max'=>10),
			array('notes, create_time, update_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, invoice_id, order_detail_id, description, price, quantity, total_no_vat, vat, vat_value, total_vat, discount, discount_value, total, notes, create_time, update_time', 'safe', 'on'=>'search'),
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
			'invoice' => array(self::BELONGS_TO, 'Invoice', 'invoice_id'),
			'orderDetail' => array(self::BELONGS_TO, 'OrderDetail', 'order_detail_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app', 'ID'),
			'invoice_id' => Yii::t('app', 'Invoice'),
			'order_detail_id' => Yii::t('app', 'Order Detail'),
			'description' => Yii::t('app', 'Description'),
			'price' => Yii::t('app', 'Price'),
			'quantity' => Yii::t('app', 'Quantity'),
			'total_no_vat' => Yii::t('app', 'Total No Vat'),
			'vat' => Yii::t('app', 'Vat'),
			'vat_value' => Yii::t('app', 'Vat Value'),
			'total_vat' => Yii::t('app', 'Total Vat'),
			'discount' => Yii::t('app', 'Discount'),
			'discount_value' => Yii::t('app', 'Discount Value'),
			'total' => Yii::t('app', 'Total'),
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
		$criteria->compare('invoice_id',$this->invoice_id,true);
		$criteria->compare('order_detail_id',$this->order_detail_id,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('quantity',$this->quantity,true);
		$criteria->compare('total_no_vat',$this->total_no_vat,true);
		$criteria->compare('vat',$this->vat,true);
		$criteria->compare('vat_value',$this->vat_value,true);
		$criteria->compare('total_vat',$this->total_vat,true);
		$criteria->compare('discount',$this->discount,true);
		$criteria->compare('discount_value',$this->discount_value,true);
		$criteria->compare('total',$this->total,true);
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
	 * @return InvoiceRow the static model class
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
