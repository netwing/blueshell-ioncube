<?php
/* @var $this SystemTemplateController */
/* @var $model SystemTemplate */

$this->pageTitle = Yii::t('app', 'Update System Templates');

$this->breadcrumbs=array(
	'System Templates'=>array('index'),
	$model->name=>array('view','id'=>$model->id, 'language' => $model->language),
	'Update',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage SystemTemplate'), 'url'=>array('admin')),
	array('label'=>Yii::t('app', 'View SystemTemplate'), 'url'=>array('view', 'id'=>$model->id, 'language' => $model->language)),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>