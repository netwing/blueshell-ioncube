<?php
/* @var $this SystemTemplateController */
/* @var $model SystemTemplate */

$this->pageTitle = Yii::t('app', 'Copy System Template');

$this->breadcrumbs=array(
	'System Templates'=>array('admin'),
	'Copy of ' . $model->name,
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage SystemTemplate'), 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model, 'languages' => $languages)); ?>