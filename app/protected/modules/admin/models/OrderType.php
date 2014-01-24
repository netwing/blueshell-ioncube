<?php

Yii::import('application.modules.admin.models.base.BaseOrderType');

class OrderType extends BaseOrderType
{

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return OrderType the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

}
