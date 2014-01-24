<?php

/**
 * This is the model class for table "{{contratti_tipo}}".
 *
 * The followings are the available columns in table '{{contratti_tipo}}':
 * @property string $contratto_tipo_id
 * @property string $contratto_tipo_nome
 * @property string $color
 * @property string $prefix
 * @property integer $rent
 * @property integer $transit
 * @property integer $sell
 * @property integer $option
 * @property integer $manage
 * @property integer $reservation
 * @property string $sort_order
 * @property integer $enabled
 * @property string $create_time
 * @property string $update_time
 */
class BaseContractType extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{contratti_tipo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rent, transit, sell, option, manage, reservation, enabled', 'numerical', 'integerOnly'=>true),
			array('contratto_tipo_nome', 'length', 'max'=>150),
			array('color, prefix', 'length', 'max'=>255),
			array('sort_order', 'length', 'max'=>11),
			array('create_time, update_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('contratto_tipo_id, contratto_tipo_nome, color, prefix, rent, transit, sell, option, manage, reservation, sort_order, enabled, create_time, update_time', 'safe', 'on'=>'search'),
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
			'contratto_tipo_id' => Yii::t('app', 'Contratto Tipo'),
			'contratto_tipo_nome' => Yii::t('app', 'Contratto Tipo Nome'),
			'color' => Yii::t('app', 'Color'),
			'prefix' => Yii::t('app', 'Prefix'),
			'rent' => Yii::t('app', 'Rent'),
			'transit' => Yii::t('app', 'Transit'),
			'sell' => Yii::t('app', 'Sell'),
			'option' => Yii::t('app', 'Option'),
			'manage' => Yii::t('app', 'Manage'),
			'reservation' => Yii::t('app', 'Reservation'),
			'sort_order' => Yii::t('app', 'Sort Order'),
			'enabled' => Yii::t('app', 'Enabled'),
			'create_time' => Yii::t('app', 'Create Time'),
			'update_time' => Yii::t('app', 'Update Time'),
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

		$criteria->compare('contratto_tipo_id',$this->contratto_tipo_id,true);
		$criteria->compare('contratto_tipo_nome',$this->contratto_tipo_nome,true);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('prefix',$this->prefix,true);
		$criteria->compare('rent',$this->rent);
		$criteria->compare('transit',$this->transit);
		$criteria->compare('sell',$this->sell);
		$criteria->compare('option',$this->option);
		$criteria->compare('manage',$this->manage);
		$criteria->compare('reservation',$this->reservation);
		$criteria->compare('sort_order',$this->sort_order,true);
		$criteria->compare('enabled',$this->enabled);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ContractType the static model class
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
