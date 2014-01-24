<?php
/* @var $this ContractTypeController */
/* @var $model ContractType */

$this->pageTitle = Yii::t('app', 'Update Contract Types');

$this->breadcrumbs=array(
	'Contract Types'=>array('index'),
	$model->contratto_tipo_id=>array('view','id'=>$model->contratto_tipo_id),
	'Update',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage ContractType'), 'url'=>array('admin')),
	array('label'=>Yii::t('app', 'Create ContractType'), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'View ContractType'), 'url'=>array('view', 'id'=>$model->contratto_tipo_id)),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>