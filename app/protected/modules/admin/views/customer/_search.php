<?php
/* @var $this CustomerController */
/* @var $model Customer */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
    'htmlOptions'=>array('class'=>'form-horizontal well'),
)); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_id', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'cliente_id', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_nominativo', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'cliente_nominativo', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_tipo', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'cliente_tipo', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_nome', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'cliente_nome', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_cognome', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'cliente_cognome', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_data_nascita', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'cliente_data_nascita', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_luogo_nascita', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'cliente_luogo_nascita', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_indirizzo', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'cliente_indirizzo', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_citta', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'cliente_citta', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_cap', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'cliente_cap', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_provincia', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'cliente_provincia', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_nazione', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'cliente_nazione', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_telefono1', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'cliente_telefono1', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_tipo_telefono1', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'cliente_tipo_telefono1', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_telefono2', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'cliente_telefono2', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_tipo_telefono2', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'cliente_tipo_telefono2', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_telefono3', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'cliente_telefono3', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_tipo_telefono3', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'cliente_tipo_telefono3', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_email', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'cliente_email', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_codice_fiscale', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'cliente_codice_fiscale', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_partita_iva', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'cliente_partita_iva', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_documento', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'cliente_documento', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_numero_documento', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'cliente_numero_documento', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_rifiuta_comunicazioni', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'cliente_rifiuta_comunicazioni', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_note', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'cliente_note', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'data_inserimento_cliente', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'data_inserimento_cliente', array('class' => 'form-control')); ?>        </div>
    </div>


    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-4">
            <button type="submit" class="btn btn-primary"><?php echo Yii::t('app', 'Search'); ?></button>
        </div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->