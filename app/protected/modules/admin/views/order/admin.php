
<?php
/* @var $this OrderController */
/* @var $model Order */

$this->pageTitle = Yii::t('app', 'Manage Orders');

$this->breadcrumbs=array(
	'Orders'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label' => Yii::t('app', 'Manage Order'), 'url'=>array('admin')),
	array('label' => Yii::t('app', 'Create Order'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#order-grid').yiiGridView('update', {
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

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'order-grid',
	'dataProvider'=>$model->show()->search(),
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
		'id',
		'customer_id' => array(
            'header'    => Yii::t('app', 'Customer'),
            'value'     => '$data->customer',
            'type'      => 'customerDetailOrderLink',
        ),
		'date' => array(
            'name'      => 'date',
            'header'    => $model->getAttributeLabel('date'),
            'value'     => '$data->date',
            'type'      => 'Date',
            'filter'    => false,
        ),
		'status_id' => array(
            'header'    => Yii::t('app', 'Status'),
            'value'     => '$data->status',
            'filter'    => CHtml::dropDownList('Order[status_id]', $model->status_id, (array('' => '') + CHtml::listData(OrderStatus::model()->findAll(array('order' => 'sort_order ASC, name ASC')), 'id', 'name')), array('id' => 'Order_status_id')),
            'type'      => 'textColor',
        ),
        'total' => array(
            'header'    => $model->getAttributeLabel('total'),
            'value'     => '$data->total',
            'filter'    => false,
            'type'      => 'currency',
            'htmlOptions'   => array('class' => 'text-right'),
        ),
        'totalBilled' => array(
            'header'    => $model->getAttributeLabel('totalBilled'),
            'value'     => '$data->totalBilled',
            'filter'    => false,
            'type'      => 'currency',
            'htmlOptions'   => array('class' => 'text-right'),
            'cssClassExpression'    =>  '($data->totalBilled < $data->total) ? "text-danger" : ""',
        ),
        'totalPaid' => array(
            'header'    => $model->getAttributeLabel('totalPaid'),
            'value'     => '$data->totalPaid',
            'filter'    => false,
            'type'      => 'currency',
            'htmlOptions'   => array('class' => 'text-right'),
            'cssClassExpression'    =>  '($data->totalPaid < $data->total) ? "text-danger" : ""',
        ),
		/*
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
    'title' => '<strong>' . Yii::t('app', 'Orders overview') . '</strong>',
    'htmlOptions' => array('class' => 'panel panel-primary'),
    'decorationCssClass' => 'panel-heading',
    'titleCssClass' => 'panel-title',
    'contentCssClass' => 'panel-body',
)); ?>

<ul class="nav nav-pills nav-stacked">
  <li>
    <a href="<?php echo $this->createUrl('admin'); ?>">
      <span class="badge pull-right"><?php echo Order::model()->show()->count(); ?></span>
      <?php echo Yii::t('app', 'All'); ?>
    </a>
  </li>
<?php foreach (OrderStatus::model()->findAll() as $status): ?>
  <li>
    <a href="<?php echo $this->createUrl('admin', array('Order[status_id]' => $status->id)); ?>">
      <span class="badge pull-right" style="background-color: <?php echo $status->color; ?>; color: <?php echo Color::getContrastYIQ($status->color); ?>">
        <?php echo Order::model()->show()->countByAttributes(array('status_id' => $status->id)); ?></span>
      <?php echo $status->name; ?>
    </a>
  </li>
<?php endforeach; ?>
</ul>

<?php
$this->endWidget();
$this->endClip();
?>
