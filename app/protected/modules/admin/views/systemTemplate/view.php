<?php
/* @var $this SystemTemplateController */
/* @var $model SystemTemplate */

$this->pageTitle = Yii::t('app', 'Update System Templates');

$this->breadcrumbs=array(
	'System Templates'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Manage SystemTemplate'), 'url'=>array('admin')),
	array('label'=>Yii::t('app', 'Copy SystemTemplate'), 'url'=>array('copy', 'id'=>$model->id, 'language' => $model->language)),
	array('label'=>Yii::t('app', 'Update SystemTemplate'), 'url'=>array('update', 'id'=>$model->id, 'language' => $model->language)),
	array('label'=>Yii::t('app', 'Delete SystemTemplate'), 
		  'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id, 'language' => $model->language),'confirm'=>'Are you sure you want to delete this item?'),
		  'visible' => ($model->language != "en"),
	),

);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
		'text_content',
		'html_content',
		'create_time',
		'update_time',
	),
)); ?>
