<?php
/* @var $this OrderDetailController */
/* @var $model OrderDetail */

$this->pageTitle = Yii::t('app', 'Update Order Details');

$this->breadcrumbs=array(
	'Order Details'=>array('order/view', 'id' => $model->order_id),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Manage OrderDetail'), 'url'=>array('admin')),
	array('label'=>Yii::t('app', 'Create OrderDetail'), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update OrderDetail'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app', 'Delete OrderDetail'), 'url'=>array('delete', 'id'=>$model->id), 'linkOptions'=>array('confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Back to order'), 'url'=>array('/admin/order/view', 'id'=>$model->order_id)),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'order_id' => array(
			'name'	=> Yii::t('app', 'Order'),
			'value'	=> $model->id . " - " . $model->order->customer->cliente_nominativo,
		),
		'product_id' => array(
			'name'	=> Yii::t('app', 'Product'),
			'value'	=> $model->product->name,
		),
		'notes',
		'price',
		'quantity',
		'total_no_vat',
		'vat',
		'total_vat',
		'discount',
		'total',
		'create_time',
		'update_time',
	),
)); ?>
