<?php
/* @var $this OrderStatusController */
/* @var $model OrderStatus */

$this->pageTitle = Yii::t('app', 'Update Order Statuses');

$this->breadcrumbs=array(
	'Order Statuses'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Manage OrderStatus', 'url'=>array('admin')),
	array('label'=>'Create OrderStatus', 'url'=>array('create')),
	array('label'=>'Update OrderStatus', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete OrderStatus', 'url'=>array('delete', 'id'=>$model->id), 'linkOptions'=>array('confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'color' => array(
			'label' => $model->getAttributeLabel("color"),
			'value' => $model,
			'type'	=> 'textColor',
		),
		'quote:booleanString',
		'opened:booleanString',
		'pending:booleanString',
		'closed:booleanString',
		'cancelled:booleanString',
		'sort_order',
		'create_time:datetimeLong',
		'update_time:datetimeLong',
	),
)); ?>
