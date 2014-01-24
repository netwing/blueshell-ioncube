<?php
/* @var $this InvoiceRowController */
/* @var $data InvoiceRow */
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?php echo CHtml::link(CHtml::encode($data->id), array('view','id'=>$data->id)); ?>
        </h3>
    </div>
    <div class="panel-body">

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_id')); ?>:</b>
	<?php echo CHtml::encode($data->invoice_id); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_detail_id')); ?>:</b>
	<?php echo CHtml::encode($data->order_detail_id); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quantity')); ?>:</b>
	<?php echo CHtml::encode($data->quantity); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_no_vat')); ?>:</b>
	<?php echo CHtml::encode($data->total_no_vat); ?><br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('vat')); ?>:</b>
	<?php echo CHtml::encode($data->vat); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vat_value')); ?>:</b>
	<?php echo CHtml::encode($data->vat_value); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_vat')); ?>:</b>
	<?php echo CHtml::encode($data->total_vat); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('discount')); ?>:</b>
	<?php echo CHtml::encode($data->discount); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('discount_value')); ?>:</b>
	<?php echo CHtml::encode($data->discount_value); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total')); ?>:</b>
	<?php echo CHtml::encode($data->total); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notes')); ?>:</b>
	<?php echo CHtml::encode($data->notes); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
	<?php echo CHtml::encode($data->update_time); ?><br />

	*/ ?>
    </div>
</div>

