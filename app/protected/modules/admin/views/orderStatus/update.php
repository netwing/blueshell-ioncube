<?php
/* @var $this OrderStatusController */
/* @var $model OrderStatus */

$this->pageTitle = Yii::t('app', 'Update Order Statuses');

$this->breadcrumbs=array(
	'Order Statuses'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('label'=>'Manage OrderStatus', 'url'=>array('admin')),
	array('label'=>'Create OrderStatus', 'url'=>array('create')),
	array('label'=>'View OrderStatus', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>