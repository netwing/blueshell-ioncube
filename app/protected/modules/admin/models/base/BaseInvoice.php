<?php

/**
 * This is the model class for table "{{invoice}}".
 *
 * The followings are the available columns in table '{{invoice}}':
 * @property string $id
 * @property string $customer_id
 * @property string $invoice_number
 * @property string $date
 * @property string $billing_header
 * @property string $billing_address
 * @property string $billing_zip
 * @property string $billing_city
 * @property string $billing_province
 * @property string $billing_country
 * @property string $billing_tax
 * @property string $shipping_header
 * @property string $shipping_address
 * @property string $shipping_zip
 * @property string $shipping_city
 * @property string $shipping_province
 * @property string $shipping_country
 * @property string $status_id
 * @property string $type_id
 * @property string $due_date
 * @property string $date_paid
 * @property string $payment_method
 * @property string $notes
 * @property string $create_time
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property InvoiceType $type
 * @property Clienti $customer
 * @property InvoiceStatus $status
 * @property InvoiceRow[] $invoiceRows
 */
class BaseInvoice extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{invoice}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customer_id, date, billing_header, billing_address, billing_tax, status_id, type_id', 'required'),
			array('customer_id', 'length', 'max'=>10),
			array('invoice_number, status_id, type_id', 'length', 'max'=>11),
			array('billing_zip, billing_city, billing_province, billing_country, shipping_header, shipping_address, shipping_zip, shipping_city, shipping_province, shipping_country, due_date, date_paid, payment_method, notes, create_time, update_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, customer_id, invoice_number, date, billing_header, billing_address, billing_zip, billing_city, billing_province, billing_country, billing_tax, shipping_header, shipping_address, shipping_zip, shipping_city, shipping_province, shipping_country, status_id, type_id, due_date, date_paid, payment_method, notes, create_time, update_time', 'safe', 'on'=>'search'),
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
			'type' => array(self::BELONGS_TO, 'InvoiceType', 'type_id'),
			'customer' => array(self::BELONGS_TO, 'Clienti', 'customer_id'),
			'status' => array(self::BELONGS_TO, 'InvoiceStatus', 'status_id'),
			'invoiceRows' => array(self::HAS_MANY, 'InvoiceRow', 'invoice_id'),
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
			'invoice_number' => Yii::t('app', 'Invoice Number'),
			'date' => Yii::t('app', 'Date'),
			'billing_header' => Yii::t('app', 'Billing Header'),
			'billing_address' => Yii::t('app', 'Billing Address'),
			'billing_zip' => Yii::t('app', 'Billing Zip'),
			'billing_city' => Yii::t('app', 'Billing City'),
			'billing_province' => Yii::t('app', 'Billing Province'),
			'billing_country' => Yii::t('app', 'Billing Country'),
			'billing_tax' => Yii::t('app', 'Billing Tax'),
			'shipping_header' => Yii::t('app', 'Shipping Header'),
			'shipping_address' => Yii::t('app', 'Shipping Address'),
			'shipping_zip' => Yii::t('app', 'Shipping Zip'),
			'shipping_city' => Yii::t('app', 'Shipping City'),
			'shipping_province' => Yii::t('app', 'Shipping Province'),
			'shipping_country' => Yii::t('app', 'Shipping Country'),
			'status_id' => Yii::t('app', 'Status'),
			'type_id' => Yii::t('app', 'Type'),
			'due_date' => Yii::t('app', 'Due Date'),
			'date_paid' => Yii::t('app', 'Date Paid'),
			'payment_method' => Yii::t('app', 'Payment Method'),
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
		$criteria->compare('invoice_number',$this->invoice_number,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('billing_header',$this->billing_header,true);
		$criteria->compare('billing_address',$this->billing_address,true);
		$criteria->compare('billing_zip',$this->billing_zip,true);
		$criteria->compare('billing_city',$this->billing_city,true);
		$criteria->compare('billing_province',$this->billing_province,true);
		$criteria->compare('billing_country',$this->billing_country,true);
		$criteria->compare('billing_tax',$this->billing_tax,true);
		$criteria->compare('shipping_header',$this->shipping_header,true);
		$criteria->compare('shipping_address',$this->shipping_address,true);
		$criteria->compare('shipping_zip',$this->shipping_zip,true);
		$criteria->compare('shipping_city',$this->shipping_city,true);
		$criteria->compare('shipping_province',$this->shipping_province,true);
		$criteria->compare('shipping_country',$this->shipping_country,true);
		$criteria->compare('status_id',$this->status_id,true);
		$criteria->compare('type_id',$this->type_id,true);
		$criteria->compare('due_date',$this->due_date,true);
		$criteria->compare('date_paid',$this->date_paid,true);
		$criteria->compare('payment_method',$this->payment_method,true);
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
	 * @return Invoice the static model class
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
