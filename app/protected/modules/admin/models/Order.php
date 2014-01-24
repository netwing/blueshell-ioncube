<?php

Yii::import('application.modules.admin.models.base.BaseOrder');

class Order extends BaseOrder
{

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array_merge(parent::rules(), array(
            array('year', 'safe'),
        ));
    } 


    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array_merge(parent::relations(), array(
            // DB relation
            'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
            // Stats
            'net_total' => array(self::STAT, 'OrderDetail', 'order_id', 'select' => 'SUM(total_no_vat)'),
            'vat_total' => array(self::STAT, 'OrderDetail', 'order_id', 'select' => 'SUM(vat_value)'),
            'discount_total' => array(self::STAT, 'OrderDetail', 'order_id', 'select' => 'SUM(discount_value)'),
            'total' => array(self::STAT, 'OrderDetail', 'order_id', 'select' => 'SUM(total)'),
            'total_work_time' => array(self::STAT, 'OrderDetail', 'order_id', 'select' => 'SUM(total_work_time)'),
        ));
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), array(
            'customer.cliente_nominativo' => Yii::t('app', 'Customer'),
            'totalBilled'   => Yii::t('app', 'Total billed'),
            'totalPaid'   => Yii::t('app', 'Total paid'),
        ));
    }

    /**
     * @return array of available scopes
     */
    public function scopes()
    {
        return array(
            'show' => array(
                // Add a condition
                'with'=> array(
                    // Use "type" relation defined in BaseOrder
                    "type" => array(
                        'condition'=> "type.show = 1",
                    )
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
     * Get year for customer
     */
    public static function getYears($customer_id = 0)
    {
        $cmd = Yii::app()->db->createCommand()
                ->selectDistinct('YEAR(date) AS year')
                ->from('{{order}}')
                ->where('customer_id = :id', array(':id' => $customer_id));
        $years = $cmd->queryColumn();

        $years = array_unique($years);
        rsort($years);
        $years = array_combine($years, $years);

        return $years;
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
        $this->getDbCriteria()->addCondition('YEAR(date) = ' . (int) $year);
        return $this;
    }

    /**
     * Invoices virtual attributes
     * @return array of related invoices
     */
    public function getInvoices()
    {
        $result = array();

        // Foreach detail of this order
        foreach ($this->orderDetails as $detail) {
            // Get all related invoice_row
            $invoice_rows = $detail->invoiceRows;
            // Foreach invoice_row, get related invoice
            if ($invoice_rows) {
                foreach ($invoice_rows as $invoice_row) {
                    $invoice = $invoice_row->invoice;
                    $result[$invoice->id] = $invoice_row->invoice;
                }
            }
        }

        return $result;
    }

    /**
     * Total billed virtual attributes
     * @return float of total billed
     */
    public function getTotalBilled()
    {
        $result = 0;
        // Load all invoices
        $invoices = $this->getInvoices();
        foreach ($invoices as $invoice) {
            foreach ($invoice->invoiceRows as $row) {
                if ($row->order_detail_id) {
                    if ($row->orderDetail->order_id == $this->id) {
                        $result+= $row->total;
                    }
                }
            }
        }

        return (float) $result;
    }

    /**
     * Total paid virtual attributes
     * Sum of all row in invoices paid
     * @return float of total paid
     */
    public function getTotalPaid()
    {
        $result = 0;
        // Load all invoices
        $invoices = $this->getInvoices();
        foreach ($invoices as $invoice) {
            if ($invoice->status->paid) {
                foreach ($invoice->invoiceRows as $row) {
                    if ($row->order_detail_id) {
                        if ($row->orderDetail->order_id == $this->id) {
                            $result+= $row->total;
                        }
                    }
                }
            }
        }

        return (float) $result;
    }

    /**
     * Convert order to invoice
     * @param $number boolean set if new invoice should be a Proforma (false) or a Invoice (true) by setting his sequential number
     * @return Invoice invoice just created
     */
    public function toInvoice($number = false)
    {
        $number = (bool) $number;
        
        // Create new invoice
        $invoice = new Invoice();
        $invoice->customer_id = $this->customer_id;
        // Default date
        $invoice->date = strftime("%Y-%m-%d", time());

        // Default unpaid values for status_id
        $status = InvoiceStatus::model()->findByAttributes(array('unpaid' => 1));
        if ($status) {
            $invoice->status_id = $status->id;
        }

        // Default types is INCOME
        $type = InvoiceType::model()->findByAttributes(array('type' => "INCOME"));
        if ($type) {
            $invoice->type_id = $type->id;
        }

        // Load customer data
        // $customer = Customer::model()->findByPk($invoice->customer_id);
        $customer = $invoice->customer;
        $invoice->billing_header = $customer->cliente_nominativo;
        $invoice->billing_address = $customer->cliente_indirizzo;
        $invoice->billing_zip = $customer->cliente_cap;
        $invoice->billing_city = $customer->cliente_citta;
        $invoice->billing_province = $customer->cliente_provincia;
        $invoice->billing_tax = $customer->cliente_codice_fiscale;
        if ($customer->cliente_partita_iva) {
            $invoice->billing_tax = $customer->cliente_partita_iva;
        }
        $invoice->shipping_header = $customer->cliente_nominativo;
        $invoice->shipping_address = $customer->cliente_indirizzo;
        $invoice->shipping_zip = $customer->cliente_cap;
        $invoice->shipping_city = $customer->cliente_citta;
        $invoice->shipping_province = $customer->cliente_provincia;

        $nazione = Nazioni::model()->findByPk($customer->cliente_nazione);
        if ($nazione) {
            $invoice->billing_country = $nazione->nazione_nome;
            $invoice->shipping_country = $nazione->nazione_nome;
        }

        if ($customer->country) {
            $contry = Yii::app()->locale->getTerritory($customer->country);
            if ($country) {
                $invoice->billing_country = $country;
                $invoice->shipping_country = $country;
            }
        }

        if ($invoice->save()) {

            if ($number) {
                $invoice->assignNextInvoiceNumber();
            }

            // foreach item
            foreach ($this->orderDetails as $detail) {
                $detail->addToInvoice($invoice);
            }
            
        }

        return $invoice;

    }

    /** BeforeSave event
     *
     * Do not allow set vector_id = 0, but set it as NULL
     */
    public function beforeSave()
    {
        if ($this->vector_id == 0) {
            $this->vector_id = null;
        }

        return parent::beforeSave();
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
     * @return Order the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

}
