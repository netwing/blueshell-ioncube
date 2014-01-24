<?php
/* @var $this ProductGroupController */
/* @var $model ProductGroup */

$this->pageTitle = Yii::t('app', 'Update Product Groups');

$this->breadcrumbs=array(
	'Product Groups'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage ProductGroup'), 'url'=>array('admin')),
	array('label'=>Yii::t('app', 'Create ProductGroup'), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'View ProductGroup'), 'url'=>array('view', 'id'=>$model->id)),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>