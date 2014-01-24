<?php
/* @var $this InvoiceController */
/* @var $model Invoice */

$this->pageTitle = Yii::t('app', 'Update Invoices');

$this->breadcrumbs=array(
	'Invoices'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage Invoice'), 'url'=>array('admin')),
	array('label'=>Yii::t('app', 'Create Invoice'), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'View Invoice'), 'url'=>array('view', 'id'=>$model->id)),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>