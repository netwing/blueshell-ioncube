<?php
/* @var $this PresenceController */
/* @var $data Presence */
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?php echo CHtml::link(CHtml::encode($data->presenza_id), array('view','id'=>$data->presenza_id)); ?>
        </h3>
    </div>
    <div class="panel-body">

	<b><?php echo CHtml::encode($data->getAttributeLabel('presenza_posto_barca')); ?>:</b>
	<?php echo CHtml::encode($data->presenza_posto_barca); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('presenza_cliente')); ?>:</b>
	<?php echo CHtml::encode($data->presenza_cliente); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('presenza_barca')); ?>:</b>
	<?php echo CHtml::encode($data->presenza_barca); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('presenza_arrivo')); ?>:</b>
	<?php echo CHtml::encode($data->presenza_arrivo); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('presenza_partenza')); ?>:</b>
	<?php echo CHtml::encode($data->presenza_partenza); ?><br />

    </div>
</div>

