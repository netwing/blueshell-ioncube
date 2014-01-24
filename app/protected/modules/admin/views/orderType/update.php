<?php
/* @var $this OrderTypeController */
/* @var $model OrderType */

$this->pageTitle = Yii::t('app', 'Update Order Types');

$this->breadcrumbs=array(
	'Order Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage OrderType'), 'url'=>array('admin')),
	array('label'=>Yii::t('app', 'Create OrderType'), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'View OrderType'), 'url'=>array('view', 'id'=>$model->id)),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>