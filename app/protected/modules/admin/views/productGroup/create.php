<?php
/* @var $this ProductGroupController */
/* @var $model ProductGroup */

$this->pageTitle = Yii::t('app', 'Create Product Groups');

$this->breadcrumbs=array(
	'Product Groups'=>array('index'),
	'Create',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage ProductGroup'), 'url'=>array('admin')),
    array('label'=>Yii::t('app', 'Create ProductGroup'), 'url'=>array('create')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>