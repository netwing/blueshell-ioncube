<?php
/* @var $this ContractTypeController */
/* @var $data ContractType */
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?php echo CHtml::link(CHtml::encode($data->contratto_tipo_id), array('view','id'=>$data->contratto_tipo_id)); ?>
        </h3>
    </div>
    <div class="panel-body">

	<b><?php echo CHtml::encode($data->getAttributeLabel('contratto_tipo_nome')); ?>:</b>
	<?php echo CHtml::encode($data->contratto_tipo_nome); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('color')); ?>:</b>
	<?php echo CHtml::encode($data->color); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prefix')); ?>:</b>
	<?php echo CHtml::encode($data->prefix); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rent')); ?>:</b>
	<?php echo CHtml::encode($data->rent); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transit')); ?>:</b>
	<?php echo CHtml::encode($data->transit); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sell')); ?>:</b>
	<?php echo CHtml::encode($data->sell); ?><br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('option')); ?>:</b>
	<?php echo CHtml::encode($data->option); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('manage')); ?>:</b>
	<?php echo CHtml::encode($data->manage); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reservation')); ?>:</b>
	<?php echo CHtml::encode($data->reservation); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sort_order')); ?>:</b>
	<?php echo CHtml::encode($data->sort_order); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
	<?php echo CHtml::encode($data->update_time); ?><br />

	*/ ?>
    </div>
</div>

