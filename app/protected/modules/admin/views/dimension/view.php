<?php
/* @var $this DimensionController */
/* @var $model Dimension */

$this->pageTitle = Yii::t('app', 'Update Dimensions');

$this->breadcrumbs=array(
	'Dimensions'=>array('index'),
	$model->dimensione_id,
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Manage Dimension'), 'url'=>array('admin')),
	array('label'=>Yii::t('app', 'Create Dimension'), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update Dimension'), 'url'=>array('update', 'id'=>$model->dimensione_id)),
	array('label'=>Yii::t('app', 'Delete Dimension'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->dimensione_id),'confirm'=>'Are you sure you want to delete this item?','params'=> array('YII_CSRF_TOKEN' => Yii::app()->request->csrfToken))),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'dimensione_id',
		'dimensione_lunghezza',
		'dimensione_larghezza',
		'dimensione_profondita',
		'dimensione_tipo',
	),
)); ?>
