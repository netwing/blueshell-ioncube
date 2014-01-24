<?php
/* @var $this ProductController */
/* @var $model Product */

$this->pageTitle = Yii::t('app', 'Create Products');

$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Create',
);

$this->menu=array(
    array('label'=>'Manage Product', 'url'=>array('admin')),
    array('label'=>'Create Product', 'url'=>array('create')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>