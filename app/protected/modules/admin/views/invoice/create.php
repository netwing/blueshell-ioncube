<?php
/* @var $this InvoiceController */
/* @var $model Invoice */

$this->pageTitle = Yii::t('app', 'Create Invoices');

$this->breadcrumbs=array(
	'Invoices'=>array('index'),
	'Create',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage Invoice'), 'url'=>array('admin')),
    array('label'=>Yii::t('app', 'Create Invoice'), 'url'=>array('create')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>