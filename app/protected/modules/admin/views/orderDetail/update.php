<?php
/* @var $this OrderDetailController */
/* @var $model OrderDetail */

$this->pageTitle = Yii::t('app', 'Update Order Details');

$this->breadcrumbs=array(
	'Order Details'=>array('order/view', 'id' => $model->order_id),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage OrderDetail'), 'url'=>array('admin')),
	array('label'=>Yii::t('app', 'Create OrderDetail'), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'View OrderDetail'), 'url'=>array('view', 'id'=>$model->id)),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>