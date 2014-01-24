<?php
/* @var $this OrderTypeController */
/* @var $model OrderType */

$this->pageTitle = Yii::t('app', 'Create Order Types');

$this->breadcrumbs=array(
	'Order Types'=>array('index'),
	'Create',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage OrderType'), 'url'=>array('admin')),
    array('label'=>Yii::t('app', 'Create OrderType'), 'url'=>array('create')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>