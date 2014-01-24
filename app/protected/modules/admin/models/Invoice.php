<?php

Yii::import('application.modules.admin.models.base.BaseInvoice');

class Invoice extends BaseInvoice
{

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array_merge(parent::relations(), array(
            // DB relation
            'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
            // Stats
            'net_total' => array(self::STAT, 'InvoiceRow', 'invoice_id', 'select' => 'SUM(total_no_vat)'),
            'vat_total' => array(self::STAT, 'InvoiceRow', 'invoice_id', 'select' => 'SUM(vat_value)'),
            'discount_total' => array(self::STAT, 'InvoiceRow', 'invoice_id', 'select' => 'SUM(discount_value)'),
            'total' => array(self::STAT, 'InvoiceRow', 'invoice_id', 'select' => 'SUM(total)'),
        ));
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array_merge(parent::rules(), array(
            array('status_id', 'default', 'value' => '2', 'on' => 'insert'),
            array('year', 'safe'),
        ));
    } 

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), array(
            'customer.cliente_nominativo' => Yii::t('app', 'Customer'),
            'status.name' => Yii::t('app', 'Invoice status'),
            'type.name' => Yii::t('app', 'Invoice type'),
            'total' => Yii::t('app', 'Total'),
        ));
    }

    /**
     * @return array of available scopes
     */
    public function scopes()
    {
        return array(
            'paid' => array(
                // Add a condition
                'with'=> array(
                    // Use "status" relation defined in BaseInvoice
                    "status" => array(
                        'condition'=> "status.paid = 1",
                    ),
                )
            ),
            'unpaid' => array(
                // Add a condition
                'with'=> array(
                    // Use "status" relation defined in BaseInvoice
                    "status" => array(
                        'condition'=> "status.unpaid = 1",
                    ),
                )
            ),
            'cancelled' => array(
                // Add a condition
                'with'=> array(
                    // Use "status" relation defined in BaseInvoice
                    "status" => array(
                        'condition'=> "status.cancelled = 1",
                    ),
                )
            ),
            'income' => array(
                // Add a condition
                'with'=> array(
                    // USe "type" relations defined in BaseInvoice
                    "type"  => array(
                        'condition'=> "type.type = 'INCOME'",  
                    ),
                )
            ),
            'outcome' => array(
                // Add a condition
                'with'=> array(
                    // USe "type" relations defined in BaseInvoice
                    "type"  => array(
                        'condition'=> "type.type = 'INCOME'",  
                    ),
                )
            ),
        );
    }

    /**
     * Virtual attribute Year
     */
    public function getYear()
    {
        return ($this->date !== null and $this->date != '0000-00-00') ? strftime("%Y", strtotime($this->date)) : null;
    }

    /**
     * Virtual attribute Year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }


    /**
     * Parameterized named scope
     * Get model in year
     */
    public function onYear($year = null)
    {
        if ($year === null) {
            return $this;
        }

        $this->getDbCriteria()->addCondition("YEAR(`" . $this->getTableAlias() . '`.`date`) = ' . (int) $year);
        return $this;
    }

    /**
     * Get year for customer
     */
    public static function getYears($customer_id = 0)
    {
        $cmd = Yii::app()->db->createCommand()
                ->selectDistinct('YEAR(date) AS year')
                ->from('{{invoice}}')
                ->where('customer_id = :id', array(':id' => $customer_id));
        $years = $cmd->queryColumn();

        $years = array_unique($years);
        rsort($years);
        if (count($years) > 0) {
            $years = array_combine($years, $years);
        } else {
            $years = array();
        }

        return $years;
    }

    /**
     * Total billed for order
     * @return float of total billed
     */
    public function getTotalBilledForOrder($order_id)
    {
        $result = 0;
        foreach ($this->invoiceRows as $row) {
            if ($row->order_detail_id) {
                if ($row->orderDetail->order_id == $order_id) {
                    $result+= $row->total;
                }
            }
        }

        return (float) $result;
    }

    /** 
     * AfterSave event
     */
    public function afterSave()
    {
        // If no invoice number and status was one of paid
        if ($this->status->paid) {

            // If not date paid, set it
            if (!$this->date_paid or $date_paid = '0000-00-00') {
                $attributes = array();
                $attributes['date_paid'] = strftime("%Y-%m-%d", time());
                $this->saveAttributes($attributes);
            }

            // If no invoice number, create it
            if ((int) $this->invoice_number === 0) {
                // Set invoice_number sequentially
                $this->assignNextInvoiceNumber();
            }
        }

        return parent::afterSave();
    }  


    /**
     * Assign next invoice number to this invoice
     * @return void
     */
    public function assignNextInvoiceNumber()
    {
        // Get invoice type
        $criteria = new CDbCriteria();
        $criteria->condition = 'invoice_number > 0';
        $criteria->compare('type_id', $this->type_id);
        // If count reset every year
        if ($this->type->year_restart) {
            if ($this->date_paid and $this->date_paid != '0000-00-00') {
                $year = strftime("%Y", strtotime($this->date_paid));
                $criteria->compare(new CDbExpression('YEAR(date_paid)'), $year);
            } else {
                $year = strftime("%Y", strtotime($this->date));
                $criteria->compare(new CDbExpression('YEAR(date)'), $year);
            }
        }
        $criteria->order = 'invoice_number DESC';
        $highest_invoice = Invoice::model()->find($criteria);
        // If not found, it's first invoice
        if ($highest_invoice === null) {
            $attributes['invoice_number'] = 1;
        } else {
            $attributes['invoice_number'] = (int) $highest_invoice->invoice_number + 1;
        }

        $this->saveAttributes($attributes);
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
        $criteria->compare('customer_id',$this->customer_id,false);
        $criteria->compare('invoice_number',$this->invoice_number,true);
        $criteria->compare('date',$this->date,true);
        $criteria->compare('status_id',$this->status_id,true);
        $criteria->compare('type_id',$this->type_id,true);
        $criteria->compare('due_date',$this->due_date,true);
        $criteria->compare('date_paid',$this->date_paid,true);
        $criteria->compare('payment_method',$this->payment_method,true);
        $criteria->compare('notes',$this->notes,true);
        $criteria->compare('create_time',$this->create_time,true);
        $criteria->compare('update_time',$this->update_time,true);

        $criteria->order = "date DESC";

        if ($this->year) {
            $criteria->addCondition("YEAR(`" . $this->getTableAlias() . '`.`date`) = ' . (int) $this->year);
        }

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

}
