<?php
/* @var $this InvoiceTypeController */
/* @var $model InvoiceType */

$this->pageTitle = Yii::t('app', 'Update Invoice Types');

$this->breadcrumbs=array(
	'Invoice Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage InvoiceType'), 'url'=>array('admin')),
	array('label'=>Yii::t('app', 'Create InvoiceType'), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'View InvoiceType'), 'url'=>array('view', 'id'=>$model->id)),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>