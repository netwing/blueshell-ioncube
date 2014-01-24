<?php
/* @var $this OrderStatusController */
/* @var $model OrderStatus */

$this->pageTitle = Yii::t('app', 'Create Order Statuses');

$this->breadcrumbs=array(
	'Order Statuses'=>array('index'),
	'Create',
);

$this->menu=array(
    array('label'=>'Manage OrderStatus', 'url'=>array('admin')),
    array('label'=>'Create OrderStatus', 'url'=>array('create')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>