
<?php
/* @var $this ContractTypeController */
/* @var $model ContractType */

$this->pageTitle = Yii::t('app', 'Manage Contract Types');

$this->breadcrumbs=array(
	'Contract Types'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label' => Yii::t('app', 'Manage ContractType'), 'url'=>array('admin')),
	array('label' => Yii::t('app', 'Create ContractType'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#contract-type-grid').yiiGridView('update', {
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
	'id'=>'contract-type-grid',
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
        'contratto_tipo_nome' => array(
            'header' => $model->getAttributeLabel('contratto_tipo_nome'),
            'value' => '$data',
            'type'  => 'textColor',
        ),
		'prefix',
		'rent:booleanIcon',
		'transit:booleanIcon',
		'sell:booleanIcon',
		'option:booleanIcon',
		'manage:booleanIcon',
		'reservation:booleanIcon',
		'sort_order',
    // Show a column with 3 icons as buttons
    array(
        'class'         => 'zii.widgets.grid.CButtonColumn',
        'htmlOptions'   => array('style' => 'white-space: nowrap'),
        'afterDelete'   => 'function(link,success,data) { if (success && data) alert(data); }',
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
            )
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

