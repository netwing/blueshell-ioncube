<?php
/* @var $this CustomerController */
/* @var $data Customer */
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?php echo CHtml::link(CHtml::encode($data->cliente_id), array('view','id'=>$data->cliente_id)); ?>
        </h3>
    </div>
    <div class="panel-body">

	<b><?php echo CHtml::encode($data->getAttributeLabel('cliente_nominativo')); ?>:</b>
	<?php echo CHtml::encode($data->cliente_nominativo); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cliente_tipo')); ?>:</b>
	<?php echo CHtml::encode($data->cliente_tipo); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cliente_nome')); ?>:</b>
	<?php echo CHtml::encode($data->cliente_nome); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cliente_cognome')); ?>:</b>
	<?php echo CHtml::encode($data->cliente_cognome); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cliente_data_nascita')); ?>:</b>
	<?php echo CHtml::encode($data->cliente_data_nascita); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cliente_luogo_nascita')); ?>:</b>
	<?php echo CHtml::encode($data->cliente_luogo_nascita); ?><br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('cliente_indirizzo')); ?>:</b>
	<?php echo CHtml::encode($data->cliente_indirizzo); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cliente_citta')); ?>:</b>
	<?php echo CHtml::encode($data->cliente_citta); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cliente_cap')); ?>:</b>
	<?php echo CHtml::encode($data->cliente_cap); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cliente_provincia')); ?>:</b>
	<?php echo CHtml::encode($data->cliente_provincia); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cliente_nazione')); ?>:</b>
	<?php echo CHtml::encode($data->cliente_nazione); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cliente_telefono1')); ?>:</b>
	<?php echo CHtml::encode($data->cliente_telefono1); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cliente_tipo_telefono1')); ?>:</b>
	<?php echo CHtml::encode($data->cliente_tipo_telefono1); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cliente_telefono2')); ?>:</b>
	<?php echo CHtml::encode($data->cliente_telefono2); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cliente_tipo_telefono2')); ?>:</b>
	<?php echo CHtml::encode($data->cliente_tipo_telefono2); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cliente_telefono3')); ?>:</b>
	<?php echo CHtml::encode($data->cliente_telefono3); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cliente_tipo_telefono3')); ?>:</b>
	<?php echo CHtml::encode($data->cliente_tipo_telefono3); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cliente_email')); ?>:</b>
	<?php echo CHtml::encode($data->cliente_email); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cliente_codice_fiscale')); ?>:</b>
	<?php echo CHtml::encode($data->cliente_codice_fiscale); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cliente_partita_iva')); ?>:</b>
	<?php echo CHtml::encode($data->cliente_partita_iva); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cliente_documento')); ?>:</b>
	<?php echo CHtml::encode($data->cliente_documento); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cliente_numero_documento')); ?>:</b>
	<?php echo CHtml::encode($data->cliente_numero_documento); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cliente_rifiuta_comunicazioni')); ?>:</b>
	<?php echo CHtml::encode($data->cliente_rifiuta_comunicazioni); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cliente_note')); ?>:</b>
	<?php echo CHtml::encode($data->cliente_note); ?><br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_inserimento_cliente')); ?>:</b>
	<?php echo CHtml::encode($data->data_inserimento_cliente); ?><br />

	*/ ?>
    </div>
</div>

