<?php
/* @var $this DimensionController */
/* @var $model Dimension */

$this->pageTitle = Yii::t('app', 'Create Dimensions');

$this->breadcrumbs=array(
	'Dimensions'=>array('index'),
	'Create',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage Dimension'), 'url'=>array('admin')),
    array('label'=>Yii::t('app', 'Create Dimension'), 'url'=>array('create')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>