<?php

Yii::import('application.modules.admin.models.base.BaseOrderDetail');

class OrderDetail extends BaseOrderDetail
{

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array_merge(parent::relations(), array(
            // DB relation
            'contract' => array(self::BELONGS_TO, 'Contract', 'contract_id'),
            // Stat relation
            'price_billed' => array(self::STAT, 'InvoiceRow', 'order_detail_id', 'select' => 'SUM(price)'),
            'quantity_billed' => array(self::STAT, 'InvoiceRow', 'order_detail_id', 'select' => 'SUM(quantity)'),
            'total_no_vat_billed' => array(self::STAT, 'InvoiceRow', 'order_detail_id', 'select' => 'SUM(total_no_vat)'),
            'vat_value_billed' => array(self::STAT, 'InvoiceRow', 'order_detail_id', 'select' => 'SUM(vat_value)'),
            'total_vat_billed' => array(self::STAT, 'InvoiceRow', 'order_detail_id', 'select' => 'SUM(total_vat)'),
            'discount_value_billed' => array(self::STAT, 'InvoiceRow', 'order_detail_id', 'select' => 'SUM(discount_value)'),
            'total_billed' => array(self::STAT, 'InvoiceRow', 'order_detail_id', 'select' => 'SUM(total)'),
        ));
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        $rules = parent::rules();
        $rules[] = array('order_id, price, quantity, total_no_vat, vat, total_vat, total', 'required');
        $rules[] = array('product_id', 'either', 'other' => 'contract_id', 'on' => 'internal');
        $rules[] = array('product_id', 'required', 'on' => 'user');
        return $rules;
    }

    /**
     * Add this detail to an invoice
     * @param $invoice Invoice
     * @return boolean success or failure
     */
    public function addToInvoice(Invoice $invoice)
    {
        // Check if already billed totally or partially or not billed
        if ($this->total != $this->total_billed) {
            $invoice_row = new InvoiceRow();
            $invoice_row->invoice_id = $invoice->id;
            $invoice_row->order_detail_id = $this->id;
            if ($this->product) {
                $invoice_row->description = $this->product->name;
            }
            if ($this->contract) {
                $description = Yii::t('app', 'Contract #{id} of {date}', array(
                        '{id}' => $this->contract->id,
                        '{date}' => $this->contract->contratto_data,
                    ));
                if ($this->contract->type->rent) {
                    $description = Yii::t('app', 'Rent contract #{id} of {date}', array(
                        '{id}' => $this->contract->id,
                        '{date}' => Yii::app()->format->formatDate($this->contract->contratto_data),
                    ));
                } elseif ($this->contract->type->sell) {
                    $description = Yii::t('app', 'Sell contract #{id} of {date}', array(
                        '{id}' => $this->contract->id,
                        '{date}' => Yii::app()->format->formatDate($this->contract->contratto_data),
                    ));
                } elseif ($this->contract->type->manage) {
                    $description = Yii::t('app', 'Manage contract #{id} of {date}', array(
                        '{id}' => $this->contract->id,
                        '{date}' => Yii::app()->format->formatDate($this->contract->contratto_data),
                    ));
                } elseif ($this->contract->type->option) {
                    $description = Yii::t('app', 'Option contract #{id} of {date}', array(
                        '{id}' => $this->contract->id,
                        '{date}' => Yii::app()->format->formatDate($this->contract->contratto_data),
                    ));
                } elseif ($this->contract->type->transit) {
                    $description = Yii::t('app', 'Transit contract #{id} of {date}', array(
                        '{id}' => $this->contract->id,
                        '{date}' => Yii::app()->format->formatDate($this->contract->contratto_data),
                    ));
                } elseif ($this->contract->type->reservation) {
                    return false;
                }
                $invoice_row->description = $description;
            }
            $invoice_row->price = $this->price - $this->price_billed;
            $quantity = $this->quantity - $this->quantity_billed;
            if ($quantity <= 0) {
                $quantity = 1;
            }
            $invoice_row->quantity = $quantity;
            $invoice_row->total_no_vat = ($this->price*$this->quantity) - $this->total_no_vat_billed;
            $invoice_row->vat = $this->vat;
            $invoice_row->vat_value = $this->vat_value - $this->vat_value_billed;
            $invoice_row->total_vat = $this->total_vat - $this->total_vat_billed;
            $invoice_row->discount = $this->discount;
            $invoice_row->discount_value = $this->discount_value - $this->discount_value_billed;
            $invoice_row->total = $this->total - $this->total_billed;

            return $invoice_row->save();
        }
        
        return false;

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

}
