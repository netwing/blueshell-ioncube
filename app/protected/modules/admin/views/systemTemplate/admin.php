
<?php
/* @var $this SystemTemplateController */
/* @var $model SystemTemplate */

$this->pageTitle = Yii::t('app', 'Manage System Templates');

$this->breadcrumbs=array(
	'System Templates'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label' => Yii::t('app', 'Manage SystemTemplate'), 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#system-template-grid').yiiGridView('update', {
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
	'id'=>'system-template-grid',
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
		'name',
		'description',
        'language' => array(
            'header'    => $model->getAttributeLabel('language'),
            'value'     => 'Yii::app()->locale->getLocaleDisplayName($data->language, "languages")',
            'filter'    => CHtml::dropDownList('SystemTemplate[language]', $model->language, ELanguagePicker::getSimpleLanguageList(true), array('id' => 'SystemTemplate_language', 'style' => 'form-control'))
        ),
        'create_time' => array(
            'header' => $model->getAttributeLabel('create_time'),
            'value' => '$data->create_time',
            'type' => 'Datetime',
        ),
		/*
		'update_time',
		*/
    // Show a column with 3 icons as buttons
    array(
        'class'         => 'zii.widgets.grid.CButtonColumn',
        'template'      => '{update} {delete} {copy}',
        'viewButtonUrl'     => 'Yii::app()->controller->createUrl("view", $data->primaryKey)',
        'updateButtonUrl'   => 'Yii::app()->controller->createUrl("update", $data->primaryKey)',
        'deleteButtonUrl'   => 'Yii::app()->controller->createUrl("delete", $data->primaryKey)',

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
                'visible'       => '($data->language != "en")',
            ),
            'copy'      => array(
                'options'       => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Copy')),
                'label'         => '<i class="fa fa-copy"></i>',
                'imageUrl'      => false,
                'url'           => 'Yii::app()->controller->createUrl("copy", $data->primaryKey)',
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


<?php 
$this->beginClip('sidebar1'); 
$this->beginWidget('zii.widgets.CPortlet', array(
    'title' => '<strong>' . Yii::t('app', 'How to create new template') . '</strong>',
    'htmlOptions' => array('class' => 'panel panel-default'),
    'decorationCssClass' => 'panel-heading',
    'titleCssClass' => 'panel-title',
    'contentCssClass' => 'panel-body',
)); ?>

<p><?php echo Yii::t('app', "You can create new template by copy an existing template for a new language and then change his content."); ?></p>

<p><?php echo Yii::t('app', "Here you can't create new template from scratch and it's not possible to delete the English template as it's used for fallback."); ?></p>


<?php
$this->endWidget();
$this->endClip();
?>
