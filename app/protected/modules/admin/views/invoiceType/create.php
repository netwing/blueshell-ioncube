<?php
/* @var $this InvoiceTypeController */
/* @var $model InvoiceType */

$this->pageTitle = Yii::t('app', 'Create Invoice Types');

$this->breadcrumbs=array(
	'Invoice Types'=>array('index'),
	'Create',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage InvoiceType'), 'url'=>array('admin')),
    array('label'=>Yii::t('app', 'Create InvoiceType'), 'url'=>array('create')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>