<?php
/* @var $this CustomerController */
/* @var $model Customer */

$this->pageTitle = Yii::t('app', 'Create Customers');

$this->breadcrumbs=array(
	'Customers'=>array('index'),
	'Create',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage Customer'), 'url'=>array('admin')),
    array('label'=>Yii::t('app', 'Create Customer'), 'url'=>array('create')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>