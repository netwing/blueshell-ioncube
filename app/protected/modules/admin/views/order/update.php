<?php
/* @var $this OrderController */
/* @var $model Order */

$this->pageTitle = Yii::t('app', 'Update Orders');

$this->breadcrumbs=array(
	'Orders'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage Order'), 'url'=>array('admin')),
	array('label'=>Yii::t('app', 'Create Order'), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'View Order'), 'url'=>array('view', 'id'=>$model->id)),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>