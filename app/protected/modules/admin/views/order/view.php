<?php
/* @var $this OrderController */
/* @var $model Order */

$this->pageTitle = Yii::t('app', 'Update Orders');

$this->breadcrumbs=array(
	'Orders'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Manage Order'), 'url'=>array('admin')),
	array('label'=>Yii::t('app', 'Create Order'), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update Order'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app', 'Delete Order'), 'url'=>array('delete', 'id'=>$model->id), 'linkOptions'=>array('confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Add details'),  'url'=>array('orderDetail/create', 'orderid'=>$model->id)),
);
?>

<?php 
$purifier = new CHtmlPurifier();
$purifier->options = array(
    'HTML.Allowed' => 'br',
);

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
        /*
        'customer_id' => array(
            'label' => $model->getAttributeLabel('customer_id'),
            'value' => $model->customer->cliente_nominativo,
        ),*/
        'customer.cliente_nominativo' => array(
            'label' => $model->getAttributeLabel('customer.cliente_nominativo'),
            'value' => '<a href="' . Yii::app()->createUrl('/admin/customer/detail', array('id' => $model->customer->cliente_id, '#' => 'order')) . '">' . $model->customer->cliente_nominativo . '</a>',
            'type'  => 'html',
        ),
		'vector_id' => array(
			'label' => $model->getAttributeLabel('vector_id'),
			'value'	=> ($model->vector) ? $model->vector->barca_nome : null,
		),
        'date' => array(
            'label' => $model->getAttributeLabel('date'),
            'value' => $model->date,
            'type'  => 'DateLong',
        ),
        'work_date' => array(
            'label' => $model->getAttributeLabel('work_date'),
            'value' => $model->work_date,
            'type'  => 'DateFull',
        ),
		'due_date' => array(
			'label'	=> $model->getAttributeLabel('due_date'),
			'value' => $model->due_date,
            'type'  => 'DateFull',
		),
		'status_id' => array(
			'label'	=> $model->getAttributeLabel('status'),
			'value'	=> $model->status->name,
		),
        'work_number',
		'notes:ntext',
        'create_time' => array(
            'label' => $model->getAttributeLabel('create_time'),
            'value' => $model->create_time,
            'type' => 'Datetime',
        ),
        'update_time' => array(
            'label' => $model->getAttributeLabel('update_time'),
            'value' => $model->update_time,
            'type' => 'Datetime',
        ),
	),
)); ?>

<?php 
$dataProvider = new CArrayDataProvider($model->orderDetails, array(
    'pagination'=>array(
        'pageSize'=>-1,
    ),
));
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'order-grid',
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
		'product_id' => array(
			'header' => Yii::t('app', 'Product'),
			'value'	=> '($data->product) ? 
                (CHtml::encode($data->product->name) . ( ($data->notes) ? "<br /><small>" . CHtml::encode($data->notes) . "</small>" : "")) : 
                Yii::t("app", "Contract #{id}", array("{id}" => $data->contract_id))',
            'type'  => 'raw',
		),
        'price' => array(
            'header'        => Yii::t('app', 'Price'),
            'htmlOptions'   => array('class' => 'text-right'),
            'value'         => '$data->price',
            'type'  => 'currency',
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
            'type'  => 'currency',
        ),
		'total_billed' => array(
            'header' => Yii::t('app', 'Billed'),
            'htmlOptions'   => array('class' => 'text-right'),
            'value' => '$data->total_billed',
            'type'  => 'currency',
            'cssClassExpression'    =>  '($data->total_billed < $data->total) ? "text-danger" : ""',
        ),
    // Show a column with 3 icons as buttons
    array(
        'class'         => 'zii.widgets.grid.CButtonColumn',
        'htmlOptions'   => array('style' => 'white-space: nowrap'),
        'afterDelete'   => 'function(link,success,data) { if (success && data) alert(data); }',
        'template'      => '{view} {update} {delete} {contract}',
        'buttons'       => array(
            'view'      => array(
                'options'       => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'View')),
                'label'         => '<i class="fa fa-eye"></i>',
                'imageUrl'      => false,
                'url'			=> 'Yii::app()->createUrl("/admin/orderDetail/view", array("id" => $data->id))',
                'visible'       => '($data->product)',
            ),
            'update'      => array(
                'options'       => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Update')),
                'label'         => '<i class="fa fa-pencil"></i>',
                'imageUrl'      => false,
                'url'           => 'Yii::app()->createUrl("/admin/orderDetail/update", array("id" => $data->id))',
                'visible'       => '($data->product)',
            ),
            'delete'      => array(
                'options'       => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Delete')),
                'label'         => '<i class="fa fa-times"></i>',
                'imageUrl'      => false,
                'url'			=> 'Yii::app()->createUrl("/admin/orderDetail/delete", array("id" => $data->id))',
                'visible'       => '($data->product)',
            ),
            'contract'      => array(
                'options'       => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Show contract')),
                'label'         => '<i class="fa fa-file-o"></i>',
                'imageUrl'      => false,
                'url'           => '"../riepilogo.php?id=" . $data->contract_id',
                'visible'       => '($data->contract)',
            ),
        )
    ),
	),
)); ?>

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
        <a href="<?php echo $this->createUrl('print', array('id' => $model->id, 'output' => 'I')); ?>" target="_blank" class="btn btn-success btn-block"><?php echo Yii::t('app', 'Show order'); ?></a>
    </div>

    <div class="col-xs-6">
        <a href="<?php echo $this->createUrl('print', array('id' => $model->id)); ?>" class="btn btn-success btn-block"><?php echo Yii::t('app', 'Print order'); ?></a>
    </div>

</div>

<?php $this->endClip(); ?>

<?php 
$this->beginClip('sidebar2'); 
$this->beginWidget('zii.widgets.CPortlet', array(
    'title' => '<strong>' . Yii::t('app', 'Related invoices') . '</strong>',
    'htmlOptions' => array('class' => 'panel panel-default'),
    'decorationCssClass' => 'panel-heading',
    'titleCssClass' => 'panel-title',
    'contentCssClass' => 'panel-body',
)); ?>

<?php $invoices = $model->invoices; ?>
<?php if (count($invoices) > 0): ?>
<table class="table table-hover table-bordered">
<?php foreach ($invoices as $id => $invoice): ?>
    <tr>
        <td>
            <a href="<?php echo $this->createUrl('/admin/invoice/view', array('id' => $invoice->id)); ?>">
            <?php echo ($invoice->invoice_number) ? $invoice->invoice_number : "#" . $invoice->id; ?>
            </a>
        </td>
        <td>
        <?php echo Yii::app()->format->textColor($invoice->status); ?>
        </td>
        <td class="text-right"><?php echo Yii::app()->format->formatCurrency($invoice->getTotalBilledForOrder($model->id)); ?></td>
    </tr>
<?php endforeach; ?>
    <tr>
        <td colspan="2"><?php echo Yii::t('app', 'Total billed'); ?></td>
        <td class="text-right">
            <?php echo Yii::app()->format->formatCurrency($model->totalBilled); ?>
        </td>
    </tr>
</table>
<?php else: ?>
    <p><?php echo Yii::t('app', 'No invoices found for this order.'); ?></p>
<?php endif; ?>

<?php if ((float) $model->totalBilled < (float) $model->total): ?>
<div class="row" style="margin-bottom: 10px">
    <div class="col-xs-12">
        <a href="<?php echo $this->createUrl('toInvoice', array('id' => $model->id, 'n' => 1)); ?>" class="btn btn-warning btn-block">
            <?php echo Yii::t('app', 'Invoice unbilled items'); ?></a>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <a href="<?php echo $this->createUrl('toInvoice', array('id' => $model->id)); ?>" class="btn btn-warning btn-block">
            <?php echo Yii::t('app', 'Create proforma'); ?></a>
    </div>
</div>
<?php else: ?>
    <p><?php echo Yii::t('app', 'No billable items found in this order.'); ?></p>
<?php endif; ?>

<?php
$this->endWidget();
$this->endClip();
?>
<?php
$this->beginClip('sidebar3'); 
$this->beginWidget('zii.widgets.CPortlet', array(
    'title' => '<strong>' . Yii::t('app', 'Total work time') . '</strong>',
    'htmlOptions' => array('class' => 'panel panel-default'),
    'decorationCssClass' => 'panel-heading',
    'titleCssClass' => 'panel-title',
    'contentCssClass' => 'panel-body',
)); ?>
<?php echo Yii::t('app', 'This order need about {time} total hours of work.', array('{time}' => ceil($model->total_work_time/60))); ?>
<?php
$this->endWidget();
$this->endClip();
?>
