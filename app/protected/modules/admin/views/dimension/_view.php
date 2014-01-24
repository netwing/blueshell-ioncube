<?php
/* @var $this DimensionController */
/* @var $data Dimension */
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?php echo CHtml::link(CHtml::encode($data->dimensione_id), array('view','id'=>$data->dimensione_id)); ?>
        </h3>
    </div>
    <div class="panel-body">

	<b><?php echo CHtml::encode($data->getAttributeLabel('dimensione_lunghezza')); ?>:</b>
	<?php echo CHtml::encode($data->dimensione_lunghezza); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dimensione_larghezza')); ?>:</b>
	<?php echo CHtml::encode($data->dimensione_larghezza); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dimensione_profondita')); ?>:</b>
	<?php echo CHtml::encode($data->dimensione_profondita); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dimensione_tipo')); ?>:</b>
	<?php echo CHtml::encode($data->dimensione_tipo); ?><br />

    </div>
</div>

