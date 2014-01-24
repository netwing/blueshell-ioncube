<?php
/* @var $this InvoiceStatusController */
/* @var $model InvoiceStatus */

$this->pageTitle = Yii::t('app', 'Update Invoice Statuses');

$this->breadcrumbs=array(
	'Invoice Statuses'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Manage InvoiceStatus'), 'url'=>array('admin')),
	array('label'=>Yii::t('app', 'Create InvoiceStatus'), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update InvoiceStatus'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app', 'Delete InvoiceStatus'), 'url'=>array('delete', 'id'=>$model->id), 'linkOptions'=>array('confirm'=>'Are you sure you want to delete this item?')),
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
		'paid:booleanString',
		'unpaid:booleanString',
		'cancelled:booleanString',
		'sort_order',
		'create_time:datetimeLong',
		'update_time:datetimeLong',
	),
)); ?>
