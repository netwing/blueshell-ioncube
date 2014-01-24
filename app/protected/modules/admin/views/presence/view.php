<?php
/* @var $this PresenceController */
/* @var $model Presence */

$this->pageTitle = Yii::t('app', 'Update Presences');

$this->breadcrumbs=array(
	'Presences'=>array('index'),
	$model->presenza_id,
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Manage Presence'), 'url'=>array('admin')),
	array('label'=>Yii::t('app', 'Create Presence'), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update Presence'), 'url'=>array('update', 'id'=>$model->presenza_id)),
	array('label'=>Yii::t('app', 'Delete Presence'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->presenza_id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'presenza_id',
		'presenza_posto_barca',
		'presenza_cliente',
		'presenza_barca',
		'presenza_arrivo',
		'presenza_partenza',
	),
)); ?>
