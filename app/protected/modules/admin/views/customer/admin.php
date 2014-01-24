
<?php
/* @var $this CustomerController */
/* @var $model Customer */

$this->pageTitle = Yii::t('app', 'Manage Customers');

$this->breadcrumbs=array(
	'Customers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label' => Yii::t('app', 'Manage Customer'), 'url'=>array('admin')),
	array('label' => Yii::t('app', 'Create Customer'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#customer-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<p>
<?php echo Yii::t('app', 'You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.'); ?></p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn btn-default')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'customer-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'rowCssClass'   => array(),
	'itemsCssClass' => 'table table-hover table-bordered',
	'pagerCssClass'     => "col-md-12 text-right",
	'pager'             => array(
	    'header'                => '',
	    'internalPageCssClass'  => '',
	    'firstPageCssClass'     => '',
	    'lastPageCssClass'      => '',
	    'selectedPageCssClass'  => 'active',
	    'htmlOptions'   => array(
	        'class'     => 'pagination pagination-sm',
	    )
	),
	'columns'=>array(
		'cliente_nominativo',
		'cliente_tipo',
		'cliente_nome',
		'cliente_cognome',
        'cliente_telefono1',
		/*
        'cliente_data_nascita',
		'cliente_luogo_nascita',
		'cliente_indirizzo',
		'cliente_citta',
		'cliente_cap',
		'cliente_provincia',
		'cliente_nazione',
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
		*/
    // Show a column with 3 icons as buttons
    array(
        'class'         => 'zii.widgets.grid.CButtonColumn',
        'htmlOptions'   => array('style' => 'white-space: nowrap'),
        'afterDelete'   => 'function(link,success,data) { if (success && data) alert(data); }',
        'template'      => '{view} {update} {delete} {detail}',
        'buttons'       => array(
            'view'      => array(
                'options'       => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'View')),
                'label'         => '<i class="fa fa-eye"></i>',
                'imageUrl'      => false,
            ),
            'update'      => array(
                'options'       => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Update')),
                'label'         => '<i class="fa fa-pencil"></i>',
                'imageUrl'      => false,
            ),
            'delete'      => array(
                'options'       => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Delete')),
                'label'         => '<i class="fa fa-times"></i>',
                'imageUrl'      => false,
            ),
            'detail'      => array(
                'options'       => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Details')),
                'label'         => '<i class="fa fa-file-text"></i>',
                'imageUrl'      => false,
                'url'           => 'Yii::app()->createUrl("/admin/customer/detail", array("id" => $data->cliente_id))',
                // 'visible'       => '($data->orderDetail)',
            ),
        )
    ),
    /*
    // Show a column with dropdown actions
    array( 'header'=>'Action', 'type'=>'raw',
        'value'=>'\'
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                Action <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="\' . Yii::app()->createUrl("/admin/user/update", array("id" => $data->id)) . \'">Edit \' . $data->id . \'</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </div>
            \'', 
        ),    
    */
	),
)); ?>

