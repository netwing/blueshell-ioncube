<?php
/* @var $this InvoiceRowController */
/* @var $model InvoiceRow */

$this->pageTitle = Yii::t('app', 'Update Invoice Rows');

$this->breadcrumbs=array(
	'Invoice Rows'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Manage InvoiceRow'), 'url'=>array('admin')),
	array('label'=>Yii::t('app', 'Create InvoiceRow'), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update InvoiceRow'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app', 'Delete InvoiceRow'), 'url'=>array('delete', 'id'=>$model->id), 'linkOptions'=>array('confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'invoice_id',
		'order_detail_id',
		'description',
		'price',
		'quantity',
		'total_no_vat',
		'vat',
		'vat_value',
		'total_vat',
		'discount',
		'discount_value',
		'total',
		'notes',
		'create_time',
		'update_time',
	),
)); ?>
