<?php
/* @var $this InvoiceController */
/* @var $model Invoice */

$this->pageTitle = Yii::t('app', 'Update Invoices');

$this->breadcrumbs=array(
	'Invoices'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Manage Invoice'), 'url'=>array('admin')),
    array('label'=>Yii::t('app', 'Create Invoice'), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update Invoice'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app', 'Delete Invoice'), 'url'=>array('delete', 'id'=>$model->id), 'linkOptions'=>array('confirm'=>'Are you sure you want to delete this item?')),
    array(
        'label'=>Yii::t('app', 'Add row'), 
        'url'=>array('invoiceRow/create', 'invoiceid' => $model->id),
    ),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
        'customer.cliente_nominativo' => array(
            'label' => $model->getAttributeLabel('customer.cliente_nominativo'),
            'value' => '<a href="' . Yii::app()->createUrl('/admin/customer/detail', array('id' => $model->customer->cliente_id, '#' => 'invoice')) . '">' . $model->customer->cliente_nominativo . '</a>',
            'type'  => 'html',
        ),
        'invoice_number' => array(
            'label' => $model->getAttributeLabel('invoice_number'),
            'value' => ($model->invoice_number > 0) ? $model->invoice_number : null,
        ),
		'date:dateLong',
		'billing_address' => array(
			'label' => Yii::t('app', 'Billing address'),
			'value'	=> $model->billing_header . ", " . 
                       $model->billing_address . ", " . 
                       $model->billing_zip . ", " . 
                       $model->billing_city . ", " . 
                       $model->billing_province . ", " . 
                       $model->billing_country . ", " . 
                       $model->billing_tax,
		),
		'shipping_address' => array(
			'label' => Yii::t('app', 'Shipping address'),
            'value' => $model->shipping_header . ", " . 
                       $model->shipping_address . ", " . 
                       $model->shipping_zip . ", " . 
                       $model->shipping_city . ", " . 
                       $model->shipping_province . ", " . 
                       $model->shipping_country,
		),
		'status.name' => array(
			'label' => $model->getAttributeLabel("status.name"),
			'value' => $model->status,
			'type'	=> 'textColor',
		),

		'type.name',
		'due_date:dateLong',
		'date_paid:dateLong',
		'payment_method',
		'notes',
		'create_time:datetimeLong',
		'update_time:datetimeLong',
	),
)); ?>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'invoice-row-split-form',
    'action' => $this->createUrl('split', array('id' => $model->id)),
)); ?>
<?php 
$dataProvider = new CArrayDataProvider($model->invoiceRows, array(
    'pagination'=>array(
        'pageSize'=>-1,
    ),
));
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'invoice-row-grid',
	'dataProvider' => $dataProvider,
	// 'filter'=>$model,
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
        // Show a column with checkbox
        array(
            'class'             => 'zii.widgets.grid.CCheckBoxColumn',
            'selectableRows'    => 2,
            'visible'           => !$model->status->paid,
            'footer'            => '<button type="submit" class="btn btn-link btn-xs">' . Yii::t('app', 'Split') . '</button>',
            'visible'           => ($dataProvider->getItemCount() > 1),
        ),
		    'description' => array(
            'header' => InvoiceRow::model()->getAttributeLabel("description"),
            'value'  => '$data->description',
        ),
        'price' => array(
            'header'        => Yii::t('app', 'Price'),
            'htmlOptions'   => array('class' => 'text-right'),
            'value'         => '$data->price',
            'type'          => 'currency',
        ),
        'quantity' => array(
            'header'        => Yii::t('app', 'Quantity'),
            'htmlOptions'   => array('class' => 'text-right'),
            'value'         => '$data->quantity',
        ),
        'vat' => array(
            'header'        => Yii::t('app', 'Vat'),
            'htmlOptions'   => array('class' => 'text-right'),
            'value'         => '$data->vat',
        ),
		'discount' => array(
            'header'        => Yii::t('app', 'Discount'),
            'htmlOptions'   => array('class' => 'text-right'),
            'value'         => '$data->discount',
        ),
		'total' => array(
            'header' => Yii::t('app', 'Sub total'),
            'htmlOptions'   => array('class' => 'text-right'),
            'value' => '$data->total',
            'type'          => 'currency',
        ),
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
                    'url'			=> 'Yii::app()->createUrl("/admin/invoiceRow/view", array("id" => $data->id))',
                    // 'visible'       => '($data->product)',
                ),
                'update'      => array(
                    'options'       => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Update')),
                    'label'         => '<i class="fa fa-pencil"></i>',
                    'imageUrl'      => false,
                    'url'           => 'Yii::app()->createUrl("/admin/invoiceRow/update", array("id" => $data->id))',
                    // 'visible'       => '($data->product)',
                ),
                'delete'      => array(
                    'options'       => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Delete')),
                    'label'         => '<i class="fa fa-times"></i>',
                    'imageUrl'      => false,
                    'url'			      => 'Yii::app()->createUrl("/admin/invoiceRow/delete", array("id" => $data->id))',
                    // 'visible'       => '($data->product)',
                ),
                'detail'      => array(
                    'options'       => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Details')),
                    'label'         => '<i class="fa fa-file-text"></i>',
                    'imageUrl'      => false,
                    'url'           => 'Yii::app()->createUrl("/admin/order/view", array("id" => $data->orderDetail->order_id))',
                    'visible'       => '($data->orderDetail)',
                ),
            )
        ),
	),
)); ?>

<?php $this->endWidget(); ?>


<div class="row">

<div class="col-md-3 col-xs-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><?php echo Yii::t('app', 'Net total'); ?></h3>
      </div>
      <div class="panel-body text-right">
        <?php echo Yii::app()->format->currency($model->net_total); ?>
      </div>
    </div>
</div>

<div class="col-md-3 col-xs-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><?php echo Yii::t('app', 'VAT total'); ?></h3>
      </div>
      <div class="panel-body text-right">
        <?php echo Yii::app()->format->currency($model->vat_total); ?>
      </div>
    </div>
</div>

<div class="col-md-3 col-xs-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><?php echo Yii::t('app', 'Discount total'); ?></h3>
      </div>
      <div class="panel-body text-right">
        <?php echo Yii::app()->format->currency($model->discount_total); ?>
      </div>
    </div>
</div>

<div class="col-md-3 col-xs-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title"><?php echo Yii::t('app', 'Total'); ?></h3>
      </div>
      <div class="panel-body text-right">
        <?php echo Yii::app()->format->currency($model->total); ?>
      </div>
    </div>
</div>

</div>

<?php $this->beginClip('sidebar1'); ?>

<div class="row" style="margin-bottom: 20px">

    <div class="col-xs-6">
        <a href="<?php echo $this->createUrl('print', array('id' => $model->id, 'output' => 'I')); ?>" target="_blank" class="btn btn-success btn-block"><?php echo Yii::t('app', 'Show invoice'); ?></a>
    </div>

    <div class="col-xs-6">
        <a href="<?php echo $this->createUrl('print', array('id' => $model->id)); ?>" class="btn btn-success btn-block"><?php echo Yii::t('app', 'Print invoice'); ?></a>
    </div>

</div>

<?php $this->endClip(); ?>

<?php $this->beginClip('sidebar2'); ?>

<div class="row" style="margin-bottom: 20px">

    <div class="col-xs-12">

        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <?php echo Yii::t('app', "Mark invoice as"); ?> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
            <?php foreach (InvoiceStatus::model()->findAll(array('order' => 'sort_order')) as $status): ?>
                <li><a href="<?php echo $this->createUrl('status', array('id' => $model->id, 'status' => $status->id)); ?>">
                    <?php echo $status->name; ?></a></li>
            <?php endforeach; ?>
            </ul>
        </div>

    </div>

</div>

<?php $this->endClip(); ?>