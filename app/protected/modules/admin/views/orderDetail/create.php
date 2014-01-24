<?php
/* @var $this OrderDetailController */
/* @var $model OrderDetail */

$this->pageTitle = Yii::t('app', 'Create Order Details');

$this->breadcrumbs=array(
	'Order Details'=>array('index'),
	'Create',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage OrderDetail'), 'url'=>array('admin')),
    array('label'=>Yii::t('app', 'Create OrderDetail'), 'url'=>array('create')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>