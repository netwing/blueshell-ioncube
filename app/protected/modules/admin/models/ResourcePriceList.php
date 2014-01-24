<?php

Yii::import('application.modules.admin.models.base.BaseResourcePriceList');

class ResourcePriceList extends BaseResourcePriceList
{

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array_merge(parent::relations(), array(
            // DB relation
            'dimension' => array(self::BELONGS_TO, 'Dimension', 'listino_posto_barca_anno'),
        ));
    }

    /**
     * Parameterized named scope
     * Get model in year
     */
    public function onYear($year = null)
    {
        if ($this->listino_posto_barca_anno === null) {
            return $this;
        }
        $this->getDbCriteria()->addCondition('listino_posto_barca_anno = ' . (int) $this->listino_posto_barca_anno);
        return $this;
    }

    /**
     * Get year for ResourcePriceList
     */
    public static function getYears()
    {
        $cmd = Yii::app()->db->createCommand()
                ->selectDistinct('listino_posto_barca_anno AS year')
                ->from("{{listini_posti_barca}}");
        $years = $cmd->queryColumn();

        $years = array_unique($years);
        rsort($years);
        $years = array_combine($years, $years);

        return $years;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ResourcePriceList the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Behavior for timestamp
     */
    public function behaviors(){
        return array(
            // 'CTimestampBehavior' => array(
                // 'class' => 'zii.behaviors.CTimestampBehavior',
                // 'createAttribute' => 'create_time',
                // 'updateAttribute' => 'update_time',
            // )
        );
    }

}
