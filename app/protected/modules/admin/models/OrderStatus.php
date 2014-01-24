<?php

Yii::import('application.modules.admin.models.base.BaseOrderStatus');

class OrderStatus extends BaseOrderStatus
{

    public function relations()
    {
        $relations = parent::relations();
        $relations['order_count'] = array(self::STAT, 'Order', 'status_id', 'condition' => '1=2');
        return $relations;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return OrderStatus the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

}
