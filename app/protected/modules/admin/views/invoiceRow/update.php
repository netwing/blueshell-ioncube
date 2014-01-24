<?php
/* @var $this InvoiceRowController */
/* @var $model InvoiceRow */

$this->pageTitle = Yii::t('app', 'Update Invoice Rows');

$this->breadcrumbs=array(
	'Invoice Rows'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage InvoiceRow'), 'url'=>array('admin')),
	array('label'=>Yii::t('app', 'Create InvoiceRow'), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'View InvoiceRow'), 'url'=>array('view', 'id'=>$model->id)),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>