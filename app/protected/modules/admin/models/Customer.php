<?php

Yii::import('application.modules.admin.models.base.BaseCustomer');

class Customer extends BaseCustomer
{

    /**
     * @var integer client ID
     * @soap
     */
    public $cliente_id;
     
    /**
     * @var string client complete name
     * @soap
     */
    public $cliente_nominativo;

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array_merge(parent::relations(), array(
            'vectors' => array(self::HAS_MANY, 'Vector', 'barca_proprietario'),
            'contracts' => array(self::HAS_MANY, 'Contract', 'contratto_anagrafica2'),
            'orders' => array(self::HAS_MANY, 'Order', 'customer_id'),
            'invoices' => array(self::HAS_MANY, 'Invoice', 'customer_id'),
            // 'invoices_paid' => array(self::HAS_MANY, 'Invoice', 'customer_id', 'with' => array('paid')),
            'presences' => array(self::HAS_MANY, 'Presence', 'presenza_cliente'),
        ));
    }

    /**
     * ID Virtual attributes
     */
    public function getId()
    {
        return $this->cliente_id;
    }

    /**
     * Count of orders
     * @return float of total billed
     */
    public function getOrdersCount()
    {
        $result = 0;
        // Load all invoices
        $orders = $this->orders;
        foreach ($orders as $order) {
            if ($order->type->show) {
                $result++;
            }
        }

        return (float) $result;
    }
    /**
     * Total debt virtual attributes
     * @return float of total billed
     */
    public function getTotalDebt()
    {
        $result = 0;
        // Load all invoices
        $orders = $this->orders;
        foreach ($orders as $order) {
            $result+= $order->total;
        }

        return (float) $result;
    }

    /**
     * Total billed virtual attributes
     * @return float of total billed
     */
    public function getTotalBilled()
    {
        $result = 0;
        // Load all invoices
        $invoices = $this->invoices(array('scopes'=>array('income', 'onYear' => Yii::app()->request->getParam('year', null))));
        foreach ($invoices as $invoice) {
            $result+= $invoice->total;
        }

        return (float) $result;
    }

    /**
     * Total unbilled virtual attributes
     * @return float of total billed
     */
    public function getTotalUnbilled()
    {
        $result = $this->getTotalDebt() - $this->getTotalBilled();
        return (float) $result;
    }

    /**
     * Total paid virtual attributes
     * @return float of total billed
     */
    public function getTotalPaid()
    {
        $result = 0;
        // Load all invoices
        $invoices = $this->invoices(array('scopes'=>array('paid', 'income', 'onYear' => Yii::app()->request->getParam('year', null))));        
        foreach ($invoices as $invoice) {
            $result+= $invoice->total;
        }

        return (float) $result;
    }

    /**
     * Total unpaid virtual attributes
     * @return float of total billed
     */
    public function getTotalUnpaid()
    {
        $result = 0;
        // Load all invoices
        $invoices = $this->invoices(array('scopes'=>array('unpaid', 'income', 'onYear' => Yii::app()->request->getParam('year', null))));
        foreach ($invoices as $invoice) {
            $result+= $invoice->total;
        }

        return (float) $result;
    }

    /**
     * Years of activity (contract, order and invoices)
     */
    public function getActivityYears()
    {
        $cmd = Yii::app()->db->createCommand()
                ->selectDistinct('YEAR(contratto_data) AS year')
                ->from('{{contratti}}')
                ->where('contratto_anagrafica1 = :id OR contratto_anagrafica2 = :id', array(':id' => $this->id));
        $contracts = $cmd->queryColumn();

        $cmd = Yii::app()->db->createCommand()
                ->selectDistinct('YEAR(date) AS year')
                ->from('{{order}}')
                ->where('customer_id = :id', array(':id' => $this->id));
        $orders = $cmd->queryColumn();

        $cmd = Yii::app()->db->createCommand()
                ->selectDistinct('YEAR(date) AS year')
                ->from('{{invoice}}')
                ->where('customer_id = :id', array(':id' => $this->id));
        $invoices = $cmd->queryColumn();

        $years = array_merge($contracts, $orders, $invoices);
        $years = array_unique($years);
        rsort($years);

        return $years;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Customer the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }


}
