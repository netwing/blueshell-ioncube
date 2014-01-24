<?php

/**
 * This is the model class for table "{{listini_posti_barca}}".
 *
 * The followings are the available columns in table '{{listini_posti_barca}}':
 * @property string $listino_posto_barca_id
 * @property integer $listino_posto_barca_dimensione
 * @property integer $listino_posto_barca_anno
 * @property string $costo_giornaliero
 * @property string $costo_e1
 * @property string $costo_e2
 * @property string $costo_em
 * @property string $costo_es
 * @property string $costo_i1
 * @property string $costo_i2
 * @property string $costo_im
 * @property string $costo_is
 * @property string $costo_annuale
 * @property string $costo_condominiale
 */
class BaseResourcePriceList extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{listini_posti_barca}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('listino_posto_barca_dimensione, listino_posto_barca_anno', 'numerical', 'integerOnly'=>true),
			array('costo_giornaliero, costo_e1, costo_e2, costo_em, costo_es, costo_i1, costo_i2, costo_im, costo_is, costo_annuale, costo_condominiale', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('listino_posto_barca_id, listino_posto_barca_dimensione, listino_posto_barca_anno, costo_giornaliero, costo_e1, costo_e2, costo_em, costo_es, costo_i1, costo_i2, costo_im, costo_is, costo_annuale, costo_condominiale', 'safe', 'on'=>'search'),
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
			'listino_posto_barca_id' => Yii::t('app', 'Listino Posto Barca'),
			'listino_posto_barca_dimensione' => Yii::t('app', 'Listino Posto Barca Dimensione'),
			'listino_posto_barca_anno' => Yii::t('app', 'Listino Posto Barca Anno'),
			'costo_giornaliero' => Yii::t('app', 'Costo Giornaliero'),
			'costo_e1' => Yii::t('app', 'Costo E1'),
			'costo_e2' => Yii::t('app', 'Costo E2'),
			'costo_em' => Yii::t('app', 'Costo Em'),
			'costo_es' => Yii::t('app', 'Costo Es'),
			'costo_i1' => Yii::t('app', 'Costo I1'),
			'costo_i2' => Yii::t('app', 'Costo I2'),
			'costo_im' => Yii::t('app', 'Costo Im'),
			'costo_is' => Yii::t('app', 'Costo Is'),
			'costo_annuale' => Yii::t('app', 'Costo Annuale'),
			'costo_condominiale' => Yii::t('app', 'Costo Condominiale'),
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

		$criteria->compare('listino_posto_barca_id',$this->listino_posto_barca_id,true);
		$criteria->compare('listino_posto_barca_dimensione',$this->listino_posto_barca_dimensione);
		$criteria->compare('listino_posto_barca_anno',$this->listino_posto_barca_anno);
		$criteria->compare('costo_giornaliero',$this->costo_giornaliero,true);
		$criteria->compare('costo_e1',$this->costo_e1,true);
		$criteria->compare('costo_e2',$this->costo_e2,true);
		$criteria->compare('costo_em',$this->costo_em,true);
		$criteria->compare('costo_es',$this->costo_es,true);
		$criteria->compare('costo_i1',$this->costo_i1,true);
		$criteria->compare('costo_i2',$this->costo_i2,true);
		$criteria->compare('costo_im',$this->costo_im,true);
		$criteria->compare('costo_is',$this->costo_is,true);
		$criteria->compare('costo_annuale',$this->costo_annuale,true);
		$criteria->compare('costo_condominiale',$this->costo_condominiale,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
