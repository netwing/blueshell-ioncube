<?php
/* @var $this PresenceController */
/* @var $model Presence */

$this->pageTitle = Yii::t('app', 'Update Presences');

$this->breadcrumbs=array(
	'Presences'=>array('index'),
	$model->presenza_id=>array('view','id'=>$model->presenza_id),
	'Update',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage Presence'), 'url'=>array('admin')),
	array('label'=>Yii::t('app', 'Create Presence'), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'View Presence'), 'url'=>array('view', 'id'=>$model->presenza_id)),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>