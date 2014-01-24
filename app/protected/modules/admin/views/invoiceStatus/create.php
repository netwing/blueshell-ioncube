<?php
/* @var $this InvoiceStatusController */
/* @var $model InvoiceStatus */

$this->pageTitle = Yii::t('app', 'Create Invoice Statuses');

$this->breadcrumbs=array(
	'Invoice Statuses'=>array('index'),
	'Create',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage InvoiceStatus'), 'url'=>array('admin')),
    array('label'=>Yii::t('app', 'Create InvoiceStatus'), 'url'=>array('create')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>