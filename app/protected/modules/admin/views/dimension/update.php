<?php
/* @var $this DimensionController */
/* @var $model Dimension */

$this->pageTitle = Yii::t('app', 'Update Dimensions');

$this->breadcrumbs=array(
	'Dimensions'=>array('index'),
	$model->dimensione_id=>array('view','id'=>$model->dimensione_id),
	'Update',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage Dimension'), 'url'=>array('admin')),
	array('label'=>Yii::t('app', 'Create Dimension'), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'View Dimension'), 'url'=>array('view', 'id'=>$model->dimensione_id)),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>