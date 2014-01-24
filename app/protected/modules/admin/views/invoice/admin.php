
<?php
/* @var $this InvoiceController */
/* @var $model Invoice */

$this->pageTitle = Yii::t('app', 'Manage Invoices');

$this->breadcrumbs=array(
	'Invoices'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label' => Yii::t('app', 'Manage Invoice'), 'url'=>array('admin')),
	array('label' => Yii::t('app', 'Create Invoice'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#invoice-grid').yiiGridView('update', {
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

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'invoice-row-merge-form',
    'action' => $this->createUrl('merge'),
)); ?>
<?php 
$dataProvider = $model->search();
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'invoice-grid',
	'dataProvider' => $dataProvider,
	'filter'=>$model,
	'rowCssClass'   => array(),
	'itemsCssClass' => 'table table-hover table-bordered table-striped',
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
        // Show a column with checkbox
        array(
            'class'             => 'zii.widgets.grid.CCheckBoxColumn',
            'selectableRows'    => 2,
            'disabled'          => '($data->invoice_number)',
            'footer'            => '<button type="submit" class="btn btn-default btn-xs">' . Yii::t('app', 'Merge') . '</button>',
            'id'                => 'invoice_merge',
            'visible'           => ($dataProvider->getItemCount() > 1),
        ),
        'invoice_number' => array(
            'header'    => $model->getAttributeLabel('invoice_number'),
            'value'     => '($data->invoice_number) ? $data->type->prefix . $data->invoice_number : "#" . $data->id',
            'filter'    => CHtml::textField('Invoice[invoice_number]', $model->invoice_number, array('id' => 'Invoice_number_id')),            
        ),
        'customer_id' => array(
            'header'    => Yii::t('app', 'Customer'),
            'value'     => '$data->customer',
            'type'      => 'customerDetailInvoiceLink',
        ),
		'date:date',
        'status_id' => array(
            'header'    => $model->getAttributeLabel("status.name"),
            'value'     => '$data->status',
            'filter'    => CHtml::dropDownList('Invoice[status_id]', $model->status_id, (array('' => '') + CHtml::listData(InvoiceStatus::model()->findAll(array('order' => 'sort_order ASC, name ASC')), 'id', 'name')), array('id' => 'Invoice_status_id')),
            'type'      => 'textColor',
        ),
        'type_id' => array(
            'header'    => $model->getAttributeLabel("type.name"),
            'value'     => '$data->type',
            'filter'    => CHtml::dropDownList('Invoice[type_id]', $model->type_id, (array('' => '') + CHtml::listData(InvoiceType::model()->findAll(array('order' => 'sort_order ASC, name ASC')), 'id', 'name')), array('id' => 'Invoice_type_id')),
            'type'      => 'textColor'
        ),
		'due_date:date',
		'date_paid:date',
        'total' => array(
            'header'        => $model->getAttributeLabel('total'),
            'value'         => '$data->total',
            'htmlOptions'   => array('class' => 'text-right'),
            'type'          => 'currency',
        ),
        /*
		'notes',
		'create_time',
		'update_time',
		*/
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
	),
)); ?>

<?php $this->endWidget(); ?>

<?php 
$this->beginClip('sidebar1'); 
$this->beginWidget('zii.widgets.CPortlet', array(
    'title' => '<strong>' . Yii::t('app', 'Invoices overview') . '</strong>',
    'htmlOptions' => array('class' => 'panel panel-primary'),
    'decorationCssClass' => 'panel-heading',
    'titleCssClass' => 'panel-title',
    'contentCssClass' => 'panel-body',
)); ?>

<ul class="nav nav-pills nav-stacked">
  <li>
    <a href="<?php echo $this->createUrl('admin'); ?>">
      <span class="badge pull-right"><?php echo Invoice::model()->count(); ?></span>
      <?php echo Yii::t('app', 'All'); ?>
    </a>
  </li>
<?php foreach (InvoiceStatus::model()->findAll() as $status): ?>
  <li>
    <a href="<?php echo $this->createUrl('admin', array('Invoice[status_id]' => $status->id)); ?>">
      <span class="badge pull-right" style="background-color: <?php echo $status->color; ?>; color: <?php echo Color::getContrastYIQ($status->color); ?>">
        <?php echo Invoice::model()->countByAttributes(array('status_id' => $status->id)); ?></span>
      <?php echo $status->name; ?>
    </a>
  </li>
<?php endforeach; ?>
</ul>

<?php
$this->endWidget();
$this->endClip();
?>