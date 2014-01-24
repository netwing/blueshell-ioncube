<?php

/**
 * This is the model class for table "{{dimensioni}}".
 *
 * The followings are the available columns in table '{{dimensioni}}':
 * @property string $dimensione_id
 * @property double $dimensione_lunghezza
 * @property double $dimensione_larghezza
 * @property double $dimensione_profondita
 * @property integer $dimensione_tipo
 */
class BaseDimension extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{dimensioni}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dimensione_tipo', 'numerical', 'integerOnly'=>true),
			array('dimensione_lunghezza, dimensione_larghezza, dimensione_profondita', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('dimensione_id, dimensione_lunghezza, dimensione_larghezza, dimensione_profondita, dimensione_tipo', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'dimensione_id' => Yii::t('app', 'Dimensione'),
			'dimensione_lunghezza' => Yii::t('app', 'Dimensione Lunghezza'),
			'dimensione_larghezza' => Yii::t('app', 'Dimensione Larghezza'),
			'dimensione_profondita' => Yii::t('app', 'Dimensione Profondita'),
			'dimensione_tipo' => Yii::t('app', 'Dimensione Tipo'),
		);
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

		$criteria->compare('dimensione_id',$this->dimensione_id,true);
		$criteria->compare('dimensione_lunghezza',$this->dimensione_lunghezza);
		$criteria->compare('dimensione_larghezza',$this->dimensione_larghezza);
		$criteria->compare('dimensione_profondita',$this->dimensione_profondita);
		$criteria->compare('dimensione_tipo',$this->dimensione_tipo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
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
	 * Behavior for timestamp
	 */
	public function behaviors(){
		return array(
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				// 'createAttribute' => 'create_time',
				// 'updateAttribute' => 'update_time',
			)
		);
	}

	/**
	 * Either attributes required (one or another)
	 * Use like this: 
	 * array('attributes1', 'either', 'other' => 'attributes2')
	 */ 
	public function either($attribute_name, $params)
	{
	    $field1 = $this->getAttributeLabel($attribute_name);
	    $field2 = $this->getAttributeLabel($params['other']);
	    if (empty($this->$attribute_name) && empty($this->$params['other'])) {
	        $this->addError(
	        	$attribute_name, 
	        	Yii::t('app', "Either {field1} or {field2} is required.", array('{field1}' => $field1, '{field2}' => $field2)));
	        return false;
	    }
	    return true;
	}	 
}
