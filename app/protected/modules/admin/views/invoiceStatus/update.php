<?php
/* @var $this InvoiceStatusController */
/* @var $model InvoiceStatus */

$this->pageTitle = Yii::t('app', 'Update Invoice Statuses');

$this->breadcrumbs=array(
	'Invoice Statuses'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage InvoiceStatus'), 'url'=>array('admin')),
	array('label'=>Yii::t('app', 'Create InvoiceStatus'), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'View InvoiceStatus'), 'url'=>array('view', 'id'=>$model->id)),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>