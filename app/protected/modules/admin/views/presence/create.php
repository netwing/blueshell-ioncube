<?php
/* @var $this PresenceController */
/* @var $model Presence */

$this->pageTitle = Yii::t('app', 'Create Presences');

$this->breadcrumbs=array(
	'Presences'=>array('index'),
	'Create',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage Presence'), 'url'=>array('admin')),
    array('label'=>Yii::t('app', 'Create Presence'), 'url'=>array('create')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>