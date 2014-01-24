<?php
/* @var $this ProductController */
/* @var $model Product */

$this->pageTitle = Yii::t('app', 'Update Products');

$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Manage Product', 'url'=>array('admin')),
	array('label'=>'Create Product', 'url'=>array('create')),
	array('label'=>'Update Product', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Product', 'url'=>array('delete', 'id'=>$model->id), 'linkOptions'=>array('confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'group_id' => array(
			'label' => $model->getAttributeLabel('group_id'),
			'value'	=> $model->group->name,
		),
		'sku',
		'name',
		'description',
		'measure_unit',
		'price',
		'vat',
		'work_time',
		'enabled' => array(
			'label'	=> $model->getAttributeLabel('enabled'),
			'value'	=> $model->enabled,
			'type' => 'booleanString',
		),
		'sort_order',
		'create_time' => array(
			'label'	=> $model->getAttributeLabel('create_time'),
			'value'	=> $model->create_time,
			'type' => 'Datetime',
		),
		'update_time' => array(
			'label'	=> $model->getAttributeLabel('update_time'),
			'value'	=> $model->update_time,
			'type' => 'Datetime',
		),
	),
)); ?>
