<?php

Yii::import('application.modules.admin.models.base.BaseProduct');

class Product extends BaseProduct
{

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        $rules = parent::rules();
        $rules[] = array('group_id, sku, name, measure_unit, price, vat', 'required');
        return $rules;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Product the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

}
