<?php
/* @var $this SystemTemplateController */
/* @var $model SystemTemplate */

$this->pageTitle = Yii::t('app', 'Create System Templates');

$this->breadcrumbs=array(
	'System Templates'=>array('index'),
	'Create',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage SystemTemplate'), 'url'=>array('admin')),
    array('label'=>Yii::t('app', 'Create SystemTemplate'), 'url'=>array('create')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>