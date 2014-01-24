<?php
/* @var $this CustomerController */
/* @var $model Customer */

$this->pageTitle = Yii::t('app', 'Update Customers');

$this->breadcrumbs=array(
	'Customers'=>array('index'),
	$model->cliente_id=>array('view','id'=>$model->cliente_id),
	'Update',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage Customer'), 'url'=>array('admin')),
	array('label'=>Yii::t('app', 'Create Customer'), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'View Customer'), 'url'=>array('view', 'id'=>$model->cliente_id)),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>