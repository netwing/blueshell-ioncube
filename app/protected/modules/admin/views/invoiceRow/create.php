<?php
/* @var $this InvoiceRowController */
/* @var $model InvoiceRow */

$this->pageTitle = Yii::t('app', 'Create Invoice Rows');

$this->breadcrumbs=array(
	'Invoice Rows'=>array('index'),
	'Create',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage InvoiceRow'), 'url'=>array('admin')),
    array('label'=>Yii::t('app', 'Create InvoiceRow'), 'url'=>array('create')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>