<?php

Yii::import('application.modules.admin.models.base.BaseBarche');

class Barche extends BaseBarche
{

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Barche the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

}
