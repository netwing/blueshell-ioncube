<?php
/* @var $this InvoiceTypeController */
/* @var $model InvoiceType */

$this->pageTitle = Yii::t('app', 'Update Invoice Types');

$this->breadcrumbs=array(
	'Invoice Types'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Manage InvoiceType'), 'url'=>array('admin')),
	array('label'=>Yii::t('app', 'Create InvoiceType'), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update InvoiceType'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app', 'Delete InvoiceType'), 'url'=>array('delete', 'id'=>$model->id), 'linkOptions'=>array('confirm'=>'Are you sure you want to delete this item?')),
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
		'type:invoiceType',
		'prefix',
		'year_restart:booleanString',
		'sort_order',
		'enabled:booleanString',
		'create_time:datetimeLong',
		'update_time:datetimeLong',
	),
)); ?>
