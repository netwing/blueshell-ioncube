<?php
/* @var $this ContractTypeController */
/* @var $model ContractType */

$this->pageTitle = Yii::t('app', 'Update Contract Types');

$this->breadcrumbs=array(
	'Contract Types'=>array('index'),
	$model->contratto_tipo_id,
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Manage ContractType'), 'url'=>array('admin')),
	array('label'=>Yii::t('app', 'Create ContractType'), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update ContractType'), 'url'=>array('update', 'id'=>$model->contratto_tipo_id)),
	array('label'=>Yii::t('app', 'Delete ContractType'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->contratto_tipo_id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'contratto_tipo_nome' => array(
            'label' => $model->getAttributeLabel('contratto_tipo_nome'),
            'value' => $model,
            'type'  => 'textColor',
		),
		'prefix',
		'rent:booleanString',
		'transit:booleanString',
		'sell:booleanString',
		'option:booleanString',
		'manage:booleanString',
		'reservation:booleanString',
		'sort_order',
		'create_time:datetime',
		'update_time:datetime',
	),
)); ?>
