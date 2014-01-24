<?php
/* @var $this ProductGroupController */
/* @var $model ProductGroup */

$this->pageTitle = Yii::t('app', 'Update Product Groups');

$this->breadcrumbs=array(
	'Product Groups'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Manage ProductGroup'), 'url'=>array('admin')),
	array('label'=>Yii::t('app', 'Create ProductGroup'), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update ProductGroup'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app', 'Delete ProductGroup'), 'url'=>array('delete', 'id'=>$model->id), 'linkOptions'=>array('confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
		'enabled',
		'sort_order',
		'create_time',
		'update_time',
	),
)); ?>
