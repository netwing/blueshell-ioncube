<?php

Yii::import('application.modules.admin.models.base.BaseDimension');

class Dimension extends BaseDimension
{

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array_merge(parent::relations(), array(
            'resourcePriceLists' => array(self::HAS_MANY, 'ResourcePriceList', 'listino_posto_barca_dimensione'),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Dimension the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
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

        $criteria->compare('dimensione_lunghezza',$this->dimensione_lunghezza);
        $criteria->compare('dimensione_larghezza',$this->dimensione_larghezza);
        $criteria->compare('dimensione_profondita',$this->dimensione_profondita);

        $criteria->order = "dimensione_lunghezza ASC, dimensione_larghezza ASC, dimensione_profondita ASC";

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /** 
     * AfterSave event
     */
    public function afterSave()
    {
        if ($this->isNewRecord) {
            $years = ResourcePriceList::getYears();
            foreach ($years as $year) {
                $price = new ResourcePriceList();
                $price->listino_posto_barca_dimensione = $this->dimensione_id;
                $price->listino_posto_barca_anno = $year;
                $price->save();
            }
        }

        return parent::afterSave();
    } 

    /** 
     * AfterSave event
     */
    public function afterDelete()
    {
        $years = ResourcePriceList::getYears();
        foreach ($years as $year) {
            $price = ResourcePriceList::model()->findByAttributes(
                array(
                    'listino_posto_barca_dimensione' => $this->dimensione_id, 
                    'listino_posto_barca_anno'       => $year, 
                )
            );
            if ($price) {
                $price->delete();
            }
        }

        return parent::afterDelete();
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
