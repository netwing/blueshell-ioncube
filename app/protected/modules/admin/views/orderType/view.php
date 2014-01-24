<?php
/* @var $this OrderTypeController */
/* @var $model OrderType */

$this->pageTitle = Yii::t('app', 'Update Order Types');

$this->breadcrumbs=array(
	'Order Types'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Manage OrderType'), 'url'=>array('admin')),
	array('label'=>Yii::t('app', 'Create OrderType'), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update OrderType'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app', 'Delete OrderType'), 'url'=>array('delete', 'id'=>$model->id), 'linkOptions'=>array('confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
		'color' => array(
			'label' => $model->getAttributeLabel("color"),
			'value' => $model,
			'type'	=> 'textColor',
		),
		'show',
		'sort_order',
		'create_time',
		'update_time',
	),
)); ?>
