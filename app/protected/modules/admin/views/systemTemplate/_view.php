<?php
/* @var $this SystemTemplateController */
/* @var $data SystemTemplate */
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?php echo CHtml::link(CHtml::encode($data->id), array('view','id'=>$data->id)); ?>
        </h3>
    </div>
    <div class="panel-body">

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text_content')); ?>:</b>
	<?php echo CHtml::encode($data->text_content); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('html_content')); ?>:</b>
	<?php echo CHtml::encode($data->html_content); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
	<?php echo CHtml::encode($data->update_time); ?><br />

    </div>
</div>

