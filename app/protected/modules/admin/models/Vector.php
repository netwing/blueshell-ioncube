<?php

Yii::import('application.modules.admin.models.base.BaseVector');

class Vector extends BaseVector
{

    /**
     * @var integer vector id
     * @soap
     */
    public $barca_id;
     
    /**
     * @var string client complete name
     * @soap
     */
    public $barca_nome;

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array_merge(parent::relations(), array(
            'orders' => array(self::HAS_MANY, 'Order', 'vector_id'),
            'exBuilder' => array(self::BELONGS_TO, 'Builder', 'barca_costruttore'),
            'exInsuranceCompany' => array(self::BELONGS_TO, 'InsuranceCompany', 'barca_assicurazione'),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Vector the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

}
