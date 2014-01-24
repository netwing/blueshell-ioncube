<?php
/* @var $this OrderController */
/* @var $model Order */

$this->pageTitle = Yii::t('app', 'Create Orders');

$this->breadcrumbs=array(
	'Orders'=>array('index'),
	'Create',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage Order'), 'url'=>array('admin')),
    array('label'=>Yii::t('app', 'Create Order'), 'url'=>array('create')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>