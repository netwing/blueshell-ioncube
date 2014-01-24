<?php
/* @var $this CustomerController */
/* @var $model Customer */

$this->pageTitle = Yii::t('app', 'Customer Detail');

$this->breadcrumbs=array(
	'Customers'=>array('admin'),
	$model->cliente_id,
);

$this->menu=array(
    /*
	array('label'=>Yii::t('app', 'Manage Customer'), 'url'=>array('admin')),
	array('label'=>Yii::t('app', 'Create Customer'), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update Customer'), 'url'=>array('update', 'id'=>$model->cliente_id)),
	array('label'=>Yii::t('app', 'Delete Customer'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cliente_id),'confirm'=>'Are you sure you want to delete this item?')),
    */
    array('label'=>Yii::t('app', 'Manage Customer'), 'url'=>'../clienti.php'),
    array('label'=>Yii::t('app', 'Create Customer'), 'url'=>'../cliente_inserimento.php'),
    array('label'=>Yii::t('app', 'Update Customer'), 'url'=>'../cliente_modifica.php?id=' . $model->cliente_id),

);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cliente_nominativo',
		'cliente_tipo',
		'cliente_nome',
		'cliente_cognome',
		/*
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
		*/
	),
)); ?>

<div class="row" style="margin-top: 20px">
    <div class="col-md-12">

    <ul class="nav nav-tabs">
        <li><a href="#dashboard" data-toggle="tab" id="dashboardLink"><?php echo Yii::t('app', 'Dashboard'); ?></a></li>
        <li><a href="#contract" data-toggle="tab" id="contractLink"><?php echo Yii::t('app', 'Contracts'); ?></a></li>
        <li><a href="#order" data-toggle="tab" id="orderLink"><?php echo Yii::t('app', 'Orders'); ?></a></li>
        <li><a href="#invoice" data-toggle="tab" id="invoiceLink"><?php echo Yii::t('app', 'Invoices'); ?></a></li>
        <li><a href="#presence" data-toggle="tab" id="presenceLink"><?php echo Yii::t('app', 'Presences'); ?></a></li>
    </ul>

    <div class="tab-content">

        <div class="tab-pane" id="dashboard">

			<div class="row">

			<div class="col-sm-4">
			    <div class="panel panel-default">
			      <div class="panel-heading">
			      	<h3 class="panel-title"><?php echo Yii::t('app', 'Overview'); ?></h3>
			      </div>
			      <div class="panel-body">
					<ul class="nav nav-pills nav-stacked">
					  <li>
					      <h4><span class="label label-default pull-right"><?php echo count($model->contracts); ?></span>
					      <?php echo Yii::t('app', 'Contracts'); ?></h4>
					  </li>
					  <li>
					      <h4><span class="label label-default pull-right"><?php echo $model->ordersCount; ?></span>
					      <?php echo Yii::t('app', 'Orders'); ?></h4>
					  </li>
					  <li>
					      <h4><span class="label label-default pull-right"><?php echo count($model->invoices); ?></span>
					      <?php echo Yii::t('app', 'Invoices'); ?></h4>
					  </li>
					  <li>
					      <h4><span class="label label-default pull-right"><?php echo count($model->presences); ?></span>
					      <?php echo Yii::t('app', 'Presences'); ?></h4>
					  </li>
					</ul>			      	
			      </div>
			    </div>
			</div>

			<div class="col-sm-4">
			    <div class="panel panel-default">
			      <div class="panel-heading">
			      	<h3 class="panel-title"><?php echo Yii::t('app', 'Payments'); ?></h3>
			      </div>
			      <div class="panel-body">
					<ul class="nav nav-pills nav-stacked">
					  <li>
					      <h4><large><span class="label label-info pull-right"><?php echo Yii::app()->format->formatCurrency($model->totalDebt); ?></span>
					      <?php echo Yii::t('app', 'Debt'); ?></large></h4>
					  </li>
                      <li>
                          <h4><span class="label label-warning pull-right"><?php echo Yii::app()->format->formatCurrency($model->totalUnbilled); ?></span>
                          <?php echo Yii::t('app', 'Unbilled'); ?></h4>
                      </li>
					  <li>
					      <h4><span class="label label-primary pull-right"><?php echo Yii::app()->format->formatCurrency($model->totalBilled); ?></span>
					      <?php echo Yii::t('app', 'Billed'); ?></h4>
					  </li>
					  <li>
					      <h4><span class="label label-success pull-right"><?php echo Yii::app()->format->formatCurrency($model->totalPaid); ?></span>
					      <?php echo Yii::t('app', 'Paid'); ?></h4>
					  </li>
					  <li>
					      <h4><span class="label label-danger pull-right"><?php echo Yii::app()->format->formatCurrency($model->totalUnpaid); ?></span>
					      <?php echo Yii::t('app', 'Unpaid'); ?></h4>
					  </li>
					</ul>			      	
			      </div>
			    </div>
			</div>

			<div class="col-sm-4">
			    <div class="panel panel-default">
			      <div class="panel-heading">
			      	<h3 class="panel-title"><?php echo Yii::t('app', 'Invoices'); ?></h3>
			      </div>
			      <div class="panel-body">
					<ul class="nav nav-pills nav-stacked">
					  <li>
					      <h4><span class="label label-success pull-right"><?php echo count($model->invoices(array('scopes'=>array('paid')))); ?></span>
					      <?php echo Yii::t('app', 'Paid'); ?></h4>
					  </li>
					  <li>
					      <h4><span class="label label-danger pull-right"><?php echo count($model->invoices(array('scopes'=>array('unpaid')))); ?></span>
					      <?php echo Yii::t('app', 'Unpaid'); ?></h4>
					  </li>
					  <li>
					      <h4><span class="label label-default pull-right"><?php echo count($model->invoices(array('scopes'=>array('cancelled')))); ?></span>
					      <?php echo Yii::t('app', 'Cancelled'); ?></h4>
					  </li>
					</ul>			      	
			      </div>
			    </div>
			</div>

			</div>

        </div>

        <div class="tab-pane" id="contract">

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'contract-grid',
	'dataProvider'=>$contract->search(),
	'filter'=>$contract,
	'rowCssClass'   => array(),
    'rowCssClassExpression' =>  '(!$data->type->reservation and $data->totalBilled < $data->discountedTotal) ? "warning" : ""',
	'itemsCssClass' => 'table table-hover table-bordered',
	'pagerCssClass'     => "col-md-12 text-right",
    'afterAjaxUpdate' => "function(id, data) { ".
        $this->widget('ext.netwing.widgets.JuiDatePicker', array(
            'htmlOptions' => array(),
            'model' => $contract,
            'attribute' => 'contratto_data',
            'returnType' => 'js',
        ), true)
    ."
        if ($('#Contract_contratto_data_value').data('year') != undefined) {
            $('#Contract_contratto_data_user').datepicker('setDate', new Date($('#Contract_contratto_data_value').data('year'), $('#Contract_contratto_data_value').data('month'), $('#Contract_contratto_data_value').data('day')));
        }
    }", // necessary for JuiDatePicker
	/*
	'pager'             => array(
	    'header'                => '',
	    'internalPageCssClass'  => '',
	    'firstPageCssClass'     => '',
	    'lastPageCssClass'      => '',
	    'selectedPageCssClass'  => 'active',
	    'htmlOptions'   => array(
	        'class'     => 'well pagination pagination-sm',
	    )
	),*/
	'columns'=>array(
		'contratto_id',
        /*
		'date' => array(
            'header'    => $contract->getAttributeLabel('contratto_data'),
            'name'      => 'contratto_data',
            'value'     => '$data->contratto_data',
            'type'      => 'Date',
            'filter'    =>
                (($contract->contratto_data) ? 
                    '<div id="Contract_contratto_data_value" data-year="' . substr($contract->contratto_data, 0, 4) . '" 
                                    data-month="' . intval(intval(substr($contract->contratto_data, 5, 2))-1) . '" 
                                    data-day="' . substr($contract->contratto_data, 8, 2) . '"></div>' : "") .
                $this->widget('ext.netwing.widgets.JuiDatePicker', array(
                    'htmlOptions' => array(),
                    'model' => $contract,
                    'attribute' => 'contratto_data',
                ), true),
        ),
        */
        'year'  => array(
            'header'    => $contract->getAttributeLabel('year'),
            'value'     => '$data->year',
            'filter'    => CHtml::dropDownList('Contract[year]', $contract->year, (array(null => '') + Contract::getYears($model->id)), array('id' => 'Contract_year')),
        ),
        'contratto_inizio' => array(
            'header'    => $contract->getAttributeLabel('contratto_inizio'),
            'value'     => '$data->contratto_inizio . "<br />" . $data->contratto_fine',
            'type'      => 'date',
        ),
        'type' => array(
            'header'    => $contract->getAttributeLabel('type.contratto_tipo_nome'),
            'value'      => '$data->type',
            'type'      => 'textColor',
            'filter'    => CHtml::dropDownList('Contract[contratto_tipo]', $contract->contratto_tipo, (array('' => '') + CHtml::listData(ContractType::model()->findAll(array('order' => 'sort_order ASC, contratto_tipo_nome ASC')), 'contratto_tipo_id', 'contratto_tipo_nome')), array('id' => 'Contract_contratto_tipo')),
        ),
        'contratto_totale' => array(
            'header'    => $contract->getAttributeLabel('contratto_totale'),
            'value'     => '$data->discountedTotal',
            'type'      => 'currency',
            'htmlOptions' => array('class' => 'text-right'),
        ),
        'hasDiscount:booleanIcon',
        'contractBilled' => array(
            'header'    => $contract->getAttributeLabel('totalBilled'),
            'value'     => '$data->totalBilled',
            'type'      => 'currency',
            'htmlOptions' => array('class' => 'text-right'),
            'cssClassExpression'    =>  '(!$data->type->reservation and $data->totalBilled < $data->discountedTotal) ? "text-danger" : ""',
        ),
        'contractPaid' => array(
            'header'    => $contract->getAttributeLabel('totalPaid'),
            'value'     => '$data->totalPaid',
            'type'      => 'currency',
            'htmlOptions' => array('class' => 'text-right'),
            'cssClassExpression'    =>  '(!$data->type->reservation and $data->totalPaid < $data->discountedTotal) ? "text-danger" : ""',
        ),

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
	                'url'			=> '"../riepilogo.php?id=" . $data->contratto_id',
	            ),
	            'update'      => array(
	                'options'       => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Update')),
	                'label'         => '<i class="fa fa-pencil"></i>',
	                'imageUrl'      => false,
                    'url'           => '"../contratto_modifica.php?id=" . $data->contratto_id',
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

        </div>

        <div class="tab-pane" id="order">

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'order-grid',
	'dataProvider'=>$order->show()->search(),
	'filter'=>$order,
	'rowCssClass'   => array(),
    'rowCssClassExpression' =>  '($data->totalBilled < $data->total) ? "warning" : ""',
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
        'year'  => array(
            'header'    => $contract->getAttributeLabel('year'),
            'value'     => '$data->year',
            'filter'    => CHtml::dropDownList('Order[year]', $order->year, (array(null => '') + Order::getYears($model->id)), array('id' => 'Order_year')),
        ),
		'date' => array(
            'name'      => 'date',
            'header'    => $order->getAttributeLabel('date'),
            'value'     => '$data->date',
            'type'      => 'Date',
            'filter'    => false,
        ),
		'status_id' => array(
            'header'    => Yii::t('app', 'Status'),
            'value'     => '$data->status',
            'filter'    => CHtml::dropDownList('Order[status_id]', $order->status_id, (array('' => '') + CHtml::listData(OrderStatus::model()->findAll(array('order' => 'sort_order ASC, name ASC')), 'id', 'name')), array('id' => 'Order_status_id')),
            'type'      => 'textColor',
        ),
		'total' => array(
			'header'	=> $model->getAttributeLabel('total'),
			'value'		=> '$data->total',
			'filter'	=> false,
			'type'		=> 'currency',
			'htmlOptions' => array('class' => 'text-right'),
		),
		'totalBilled' => array(
			'header'	=> $model->getAttributeLabel('totalBilled'),
			'value'		=> '$data->totalBilled',
			'filter'	=> false,
			'type'		=> 'currency',
			'htmlOptions' => array('class' => 'text-right'),
            'cssClassExpression'    =>  '($data->totalBilled < $data->total) ? "text-danger" : ""',
		),
		'totalPaid' => array(
			'header'	=> $model->getAttributeLabel('totalPaid'),
			'value'		=> '$data->totalPaid',
			'filter'	=> false,
			'type'		=> 'currency',
			'htmlOptions' => array('class' => 'text-right'),
            'cssClassExpression'    =>  '($data->totalPaid < $data->total) ? "text-danger" : ""',
		),
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
	                'url'			=> 'Yii::app()->createUrl("/admin/order/view", array("id" => $data->id))',
	            ),
	            'update'      => array(
	                'options'       => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Update')),
	                'label'         => '<i class="fa fa-pencil"></i>',
	                'imageUrl'      => false,
	                'url'			=> 'Yii::app()->createUrl("/admin/order/update", array("id" => $data->id))',
	            ),
	            'delete'      => array(
	                'options'       => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Delete')),
	                'label'         => '<i class="fa fa-times"></i>',
	                'imageUrl'      => false,
	                'url'			=> 'Yii::app()->createUrl("/admin/order/delete", array("id" => $data->id))',
	            )
	        )
	    ),
	),
)); ?>

        </div>

        <div class="tab-pane" id="invoice">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'invoice-row-merge-form',
    'action' => $this->createUrl('/admin/invoice/merge', array('return' => '/admin/customer/detail')),
)); ?>

<?php 
$dataProvider = $invoice->search();
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'invoice-grid',
	'dataProvider' => $dataProvider,
	'filter'=>$invoice,
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
            'disabled'          => '($data->invoice_number)',
            'footer'            => '<button type="submit" class="btn btn-link btn-xs">' . Yii::t('app', 'Merge') . '</button>',
            'id'                => 'invoice_merge',
            'visible'           => ($dataProvider->getItemCount() > 1),
        ),
        'year'  => array(
            'header'    => $contract->getAttributeLabel('year'),
            'value'     => '$data->year',
            'filter'    => CHtml::dropDownList('Invoice[year]', $invoice->year, (array(null => '') + Invoice::getYears($model->id)), array('id' => 'Invoice_year')),
        ),
        'invoice_number' => array(
            'header'    => $invoice->getAttributeLabel('invoice_number'),
            'value'     => '($data->invoice_number) ? $data->type->prefix . $data->invoice_number : "#" . $data->id',
            'filter'    => CHtml::textField('Invoice[invoice_number]', $invoice->invoice_number, array('id' => 'Invoice_number_id')),            
        ),
		'date:date',
        'status_id' => array(
            'header'    => $invoice->getAttributeLabel("status.name"),
            'value'     => '$data->status',
            'filter'    => CHtml::dropDownList('Invoice[status_id]', $invoice->status_id, (array('' => '') + CHtml::listData(InvoiceStatus::model()->findAll(array('order' => 'sort_order ASC, name ASC')), 'id', 'name')), array('id' => 'Invoice_status_id')),
            'type'      => 'textColor',
        ),
        'type_id' => array(
            'header'    => $invoice->getAttributeLabel("type.name"),
            'value'     => '$data->type',
            'filter'    => CHtml::dropDownList('Invoice[type_id]', $invoice->type_id, (array('' => '') + CHtml::listData(InvoiceType::model()->findAll(array('order' => 'sort_order ASC, name ASC')), 'id', 'name')), array('id' => 'Invoice_type_id')),
            'type'      => 'textColor'
        ),
		'due_date:date',
		'date_paid:date',
        'total' => array(
            'header'        => $invoice->getAttributeLabel('total'),
            'value'         => '$data->total',
            'htmlOptions'   => array('class' => 'text-right'),
            'type'          => 'currency',
        ),
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
	                'url'			=> 'Yii::app()->createUrl("/admin/invoice/view", array("id" => $data->id))',
                ),
                'update'      => array(
                    'options'       => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Update')),
                    'label'         => '<i class="fa fa-pencil"></i>',
                    'imageUrl'      => false,
	                'url'			=> 'Yii::app()->createUrl("/admin/invoice/update", array("id" => $data->id))',
                ),
                'delete'      => array(
                    'options'       => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Delete')),
                    'label'         => '<i class="fa fa-times"></i>',
                    'imageUrl'      => false,
	                'url'			=> 'Yii::app()->createUrl("/admin/invoice/delete", array("id" => $data->id))',
                )
            )
        ),
	),
)); ?>

<?php $this->endWidget(); ?>

        </div>

        <div class="tab-pane" id="presence">
            ... to do ...
        </div>
        </div>

    </div>
</div>

<?php Yii::app()->clientScript->registerScript('invoice_customer_id_init',
'
// Javascript to enable link to tab
$("#dashboardLink").tab("show");
var url = document.location.toString();
if (url.match("#")) {
	$("#" + url.split("#")[1] + "Link").tab("show");
}
', CClientScript::POS_READY); ?>

<?php /* $this->beginClip('sidebar1'); ?>

<div class="row" style="margin-bottom: 20px">

    <div class="col-xs-12">

        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <?php echo Yii::t('app', "View activity for year"); ?> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
            <?php foreach ($model->activityYears as $year): ?>
                <li><a href="<?php echo $this->createUrl('detail', array('id' => $model->cliente_id, 'year' => $year)); ?>">
                    <?php echo $year; ?></a></li>
            <?php endforeach; ?>
            </ul>
        </div>

    </div>

</div>

<?php $this->endClip(); */ ?>

<?php 
$this->beginClip('sidebar2');
$this->beginWidget('zii.widgets.CPortlet', array(
    'title' => '<strong>' . Yii::t('app', 'Invoice unbilled') . '</strong>',
    'htmlOptions' => array('class' => 'panel panel-default'),
    'decorationCssClass' => 'panel-heading',
    'titleCssClass' => 'panel-title',
    'contentCssClass' => 'panel-body',
)); ?>
<?php if ($model->totalUnbilled > 0): ?>

<div class="row" style="margin-bottom: 20px">

    <div class="col-sm-12">
    <p><?php echo Yii::t('app', "If you want to create invoice, click this button:"); ?></p>
        <a href="<?php echo $this->createUrl('invoiceAll', array('id' => $model->cliente_id, 'number' => 1)); ?>" class="btn btn-warning btn-block">
            <?php echo Yii::t('app', 'Invoice all'); ?></a>
    </div>
</div>

<div class="row" style="margin-bottom: 20px">

    <div class="col-sm-12">
    <p><?php echo Yii::t('app', "If you want to create proforma document, click this button:"); ?></p>
        <a href="<?php echo $this->createUrl('invoiceAll', array('id' => $model->cliente_id)); ?>" class="btn btn-warning btn-block">
            <?php echo Yii::t('app', 'Create proforma'); ?></a>
    </div>

</div>
<?php else: ?>

<div class="row" style="margin-bottom: 20px">
    <div class="col-sm-12">
        <p><?php echo Yii::t('app', 'No billable items found for this customer.'); ?></p>
    </div>
</div>

<?php endif; ?>
<?php 
$this->endWidget();
$this->endClip();
?>

<?php $this->beginClip('sidebar1'); ?>
<div class="row" style="margin-bottom: 20px">

    <div class="col-xs-12">
        <a href="<?php echo $this->createUrl('detail', array('id' => $model->cliente_id, 'reset' => time())); ?>" class="btn btn-warning btn-block">
            <?php echo Yii::t('app', 'Reset view'); ?></a>
    </div>

</div>

<?php $this->endClip(); ?>