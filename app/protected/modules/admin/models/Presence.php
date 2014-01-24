<?php

Yii::import('application.modules.admin.models.base.BasePresence');

class Presence extends BasePresence
{

    /**
     * Parameterized named scope
     * Get model in year
     */
    public function onYear($year = null)
    {
        if ($year === null) {
            return $this;
        }

        $this->getDbCriteria()->addCondition("YEAR(`" . $this->getTableAlias() . '`.`presenza_arrivo`) = ' . (int) $year);
        return $this;
    }


    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Presence the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

}
