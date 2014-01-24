<?php
/* @var $this CustomerController */
/* @var $model Customer */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'customer-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
    'enableClientValidation'=>false,
    'enableAjaxValidation'=>true,
    'htmlOptions'=>array('class'=>'form-horizontal well'),
    'errorMessageCssClass' => 'text-danger'
)); ?>

	<p class="help-block"><?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.'); ?>
</p>

	<?php echo $form->errorSummary($model, null, null, array('class' => 'text-danger')); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_nominativo', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'cliente_nominativo', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'cliente_nominativo'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_tipo', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'cliente_tipo', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'cliente_tipo'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_nome', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'cliente_nome', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'cliente_nome'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_cognome', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'cliente_cognome', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'cliente_cognome'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_data_nascita', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'cliente_data_nascita', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'cliente_data_nascita'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_luogo_nascita', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'cliente_luogo_nascita', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'cliente_luogo_nascita'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_indirizzo', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'cliente_indirizzo', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'cliente_indirizzo'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_citta', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'cliente_citta', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'cliente_citta'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_cap', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'cliente_cap', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'cliente_cap'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_provincia', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'cliente_provincia', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'cliente_provincia'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_nazione', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'cliente_nazione', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'cliente_nazione'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_telefono1', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'cliente_telefono1', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'cliente_telefono1'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_tipo_telefono1', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'cliente_tipo_telefono1', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'cliente_tipo_telefono1'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_telefono2', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'cliente_telefono2', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'cliente_telefono2'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_tipo_telefono2', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'cliente_tipo_telefono2', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'cliente_tipo_telefono2'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_telefono3', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'cliente_telefono3', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'cliente_telefono3'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_tipo_telefono3', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'cliente_tipo_telefono3', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'cliente_tipo_telefono3'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_email', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'cliente_email', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'cliente_email'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_codice_fiscale', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'cliente_codice_fiscale', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'cliente_codice_fiscale'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_partita_iva', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'cliente_partita_iva', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'cliente_partita_iva'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_documento', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'cliente_documento', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'cliente_documento'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_numero_documento', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'cliente_numero_documento', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'cliente_numero_documento'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_rifiuta_comunicazioni', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'cliente_rifiuta_comunicazioni', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'cliente_rifiuta_comunicazioni'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cliente_note', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'cliente_note', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'cliente_note'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'data_inserimento_cliente', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'data_inserimento_cliente', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'data_inserimento_cliente'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
            <button type="reset" class="btn btn-warning">Reset</button>
            <button type="submit" class="btn btn-primary"><?php echo ($model->isNewRecord) ? Yii::t('app', 'Create') : Yii::t('app', 'Save'); ?></button>
        </div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
