<?php
/* @var $this ContractTypeController */
/* @var $model ContractType */

$this->pageTitle = Yii::t('app', 'Create Contract Types');

$this->breadcrumbs=array(
	'Contract Types'=>array('index'),
	'Create',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage ContractType'), 'url'=>array('admin')),
    array('label'=>Yii::t('app', 'Create ContractType'), 'url'=>array('create')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>