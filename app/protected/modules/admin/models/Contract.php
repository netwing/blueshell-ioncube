<?php

Yii::import('application.modules.admin.models.base.BaseContract');

class Contract extends BaseContract
{

    /**
     * Virtual attribute ID
     */
    public function getId()
    {
        return $this->contratto_id;
    }

    /**
     * Virtual attribute Year
     */
    public function getYear()
    {
        return ($this->contratto_data !== null and $this->contratto_data != '0000-00-00') ? strftime("%Y", strtotime($this->contratto_data)) : null;
    }

    /**
     * Virtual attribute Year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array_merge(parent::rules(), array(
            array('year', 'safe'),
        ));
    }


    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array_merge(parent::relations(), array(
            // DB relation
            'type' => array(self::BELONGS_TO, 'ContractType', 'contratto_tipo'),
            'orderDetails' => array(self::HAS_MANY, 'OrderDetail', 'contract_id'),
        ));
    }

    /**
     * Total billed virtual attributes
     * @return float of total billed
     */
    public function getTotalBilled()
    {
        $result = 0;
        // Load all invoices
        $details = $this->orderDetails;
        foreach ($details as $detail) {
            $result += $detail->total_billed;
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
        $details = $this->orderDetails;
        foreach ($details as $detail) {
            $result += $detail->order->totalPaid;
        }

        return (float) $result;
    }

    /**
     * Virtual attributes of total with discount
     * @return float of total discounted
     */
    public function getDiscountedTotal()
    {
        $result = $this->contratto_totale;
        if ($this->hasDiscount) {
            $result = (float) $this->contratto_totale - (float) $this->discountValue;
        }

        return (float) $result;
    }

    /**
     * Virtual attributes contract discount value
     * @return float amount of discount
     */
    public function getDiscountValue()
    {
        return (float) ((float) $this->contratto_totale / 100 * (float) $this->contratto_sconto);
    }

    /**
     * Virtual attributes if contract has discount
     * @return boolean if contract has discount
     */
    public function getHasDiscount()
    {
        return ((float) $this->contratto_sconto > 0) ? true : false;
    }

    /**
     * Parameterized named scope
     * Get model in year
     */
    public function onYear($year = null)
    {
        if ($year !== null) {
            $this->getDbCriteria()->addCondition("YEAR(`" . $this->getTableAlias() . '`.`contratto_data`) = ' . (int) $year);
        } elseif ($this->year !== null) {
            $this->getDbCriteria()->addCondition("YEAR(`" . $this->getTableAlias() . '`.`contratto_data`) = ' . (int) $this->year);
        } else {
            // Do nothing
        }

        return $this;
    }

    /**
     * Get year for customer
     */
    public static function getYears($customer_id = 0)
    {
        $cmd = Yii::app()->db->createCommand()
                ->selectDistinct('YEAR(contratto_data) AS year')
                ->from('{{contratti}}')
                ->where('contratto_anagrafica1 = :id OR contratto_anagrafica2 = :id', array(':id' => $customer_id));
        $years = $cmd->queryColumn();

        $years = array_unique($years);
        rsort($years);
        $years = array_combine($years, $years);

        return $years;
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

        $criteria->compare('contratto_id',$this->contratto_id,true);
        $criteria->compare('contratto_anagrafica1',$this->contratto_anagrafica1);
        $criteria->compare('contratto_anagrafica2',$this->contratto_anagrafica2);
        $criteria->compare('contratto_tipo',$this->contratto_tipo);
        $criteria->compare('contratto_barca',$this->contratto_barca);
        $criteria->compare('contratto_posto_barca',$this->contratto_posto_barca);
        $criteria->compare('contratto_periodo',$this->contratto_periodo);
        $criteria->compare('contratto_data',$this->contratto_data,true);
        $criteria->compare('contratto_inizio',$this->contratto_inizio,true);
        $criteria->compare('contratto_fine',$this->contratto_fine,true);
        $criteria->compare('contratto_numero',$this->contratto_numero,true);
        $criteria->compare('contratto_gestione_tipo',$this->contratto_gestione_tipo);
        $criteria->compare('contratto_gestione_percentuale',$this->contratto_gestione_percentuale);
        $criteria->compare('contratto_note',$this->contratto_note,true);
        $criteria->compare('contratto_imponibile',$this->contratto_imponibile,true);
        $criteria->compare('contratto_totale',$this->contratto_totale,true);
        $criteria->compare('contratto_fatturato',$this->contratto_fatturato,true);
        $criteria->compare('contratto_fatturato_chiuso',$this->contratto_fatturato_chiuso);
        $criteria->compare('contratto_sconto',$this->contratto_sconto);
        $criteria->compare('contratto_ordine',$this->contratto_ordine,true);

        $criteria->order = "contratto_data DESC";

        if ($this->year) {
            $criteria->addCondition("YEAR(`" . $this->getTableAlias() . '`.`contratto_data`) = ' . (int) $this->year);
        }

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Contract the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

}
