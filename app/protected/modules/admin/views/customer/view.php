<?php
/* @var $this CustomerController */
/* @var $model Customer */

$this->pageTitle = Yii::t('app', 'Update Customers');

$this->breadcrumbs=array(
	'Customers'=>array('index'),
	$model->cliente_id,
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Manage Customer'), 'url'=>array('admin')),
	array('label'=>Yii::t('app', 'Create Customer'), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update Customer'), 'url'=>array('update', 'id'=>$model->cliente_id)),
	array('label'=>Yii::t('app', 'Delete Customer'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cliente_id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cliente_id',
		'cliente_nominativo',
		'cliente_tipo',
		'cliente_nome',
		'cliente_cognome',
		'cliente_data_nascita',
		'cliente_luogo_nascita',
		'cliente_indirizzo',
		'cliente_citta',
		'cliente_cap',
		'cliente_provincia',
		'cliente_nazione',
		'cliente_telefono1',
		'cliente_tipo_telefono1',
		'cliente_telefono2',
		'cliente_tipo_telefono2',
		'cliente_telefono3',
		'cliente_tipo_telefono3',
		'cliente_email',
		'cliente_codice_fiscale',
		'cliente_partita_iva',
		'cliente_documento',
		'cliente_numero_documento',
		'cliente_rifiuta_comunicazioni',
		'cliente_note',
		'data_inserimento_cliente',
	),
)); ?>
