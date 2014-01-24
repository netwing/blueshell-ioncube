<?php
/* @var $this InvoiceRowController */
/* @var $model InvoiceRow */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'invoice-row-form',
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
        <?php echo $form->labelEx($model, 'description', array('class' => 'col-md-2 control-label')); ?>
        <div class="col-md-10">
        <?php echo $form->textField($model, 'description', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'description'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'price', array('class' => 'col-md-2 control-label')); ?>
        <div class="col-md-2">
        <?php echo $form->textField($model, 'price', array('class' => 'form-control', 'onkeyup' => 'calcTotal();')); ?>
        <?php echo $form->error($model,'price'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

        <?php echo $form->labelEx($model, 'quantity', array('class' => 'col-md-2 control-label')); ?>
        <div class="col-md-2">
        <?php echo $form->textField($model, 'quantity', array('class' => 'form-control', 'onkeyup' => 'calcTotal();')); ?>
        <?php echo $form->error($model,'quantity'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

        <?php echo $form->labelEx($model, 'total_no_vat', array('class' => 'col-md-2 control-label')); ?>
        <div class="col-md-2">
        <?php echo $form->textField($model, 'total_no_vat', array('class' => 'form-control', 'readonly' => 'readonly')); ?>
        <?php echo $form->error($model,'total_no_vat'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'vat', array('class' => 'col-md-2 control-label')); ?>
        <div class="col-md-2">
        <?php echo $form->textField($model, 'vat', array('class' => 'form-control', 'onkeyup' => 'calcTotal();')); ?>
        <?php echo $form->error($model,'vat'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

        <?php echo $form->labelEx($model, 'vat_value', array('class' => 'col-md-2 control-label')); ?>
        <div class="col-md-2">
        <?php echo $form->textField($model, 'vat_value', array('class' => 'form-control', 'readonly' => 'readonly')); ?>
        <?php echo $form->error($model,'vat_value'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

        <?php echo $form->labelEx($model, 'total_vat', array('class' => 'col-md-2 control-label')); ?>
        <div class="col-md-2">
        <?php echo $form->textField($model, 'total_vat', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'total_vat'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'discount', array('class' => 'col-md-2 control-label')); ?>
        <div class="col-md-2">
        <?php echo $form->textField($model, 'discount', array('class' => 'form-control', 'onkeyup' => 'calcTotal();')); ?>
        <?php echo $form->error($model,'discount'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

        <?php echo $form->labelEx($model, 'discount_value', array('class' => 'col-md-2 control-label')); ?>
        <div class="col-md-2">
        <?php echo $form->textField($model, 'discount_value', array('class' => 'form-control', 'readonly' => 'readonly')); ?>
        <?php echo $form->error($model,'discount_value'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

        <?php echo $form->labelEx($model, 'total', array('class' => 'col-md-2 control-label')); ?>
        <div class="col-md-2">
        <?php echo $form->textField($model, 'total', array('class' => 'form-control', 'readonly' => 'readonly')); ?>
        <?php echo $form->error($model,'total'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'notes', array('class' => 'col-md-2 control-label')); ?>
        <div class="col-md-10">
        <?php echo $form->textField($model, 'notes', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'notes'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <button type="reset" class="btn btn-warning">Reset</button>
            <button type="submit" class="btn btn-primary"><?php echo ($model->isNewRecord) ? Yii::t('app', 'Create') : Yii::t('app', 'Save'); ?></button>
        </div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php Yii::app()->clientScript->registerScript('form_functions',
'function calcTotal() {
    var total_no_vat = $("#InvoiceRow_price").val() * $("#InvoiceRow_quantity").val();
    $("#InvoiceRow_total_no_vat").val(total_no_vat.toFixed(2));
    var vat_value = total_no_vat / 100 * $("#InvoiceRow_vat").val();
    $("#InvoiceRow_vat_value").val(vat_value.toFixed(2));
    var total_vat = total_no_vat + vat_value;
    $("#InvoiceRow_total_vat").val(total_vat.toFixed(2));
    $("#InvoiceRow_total").val(total_vat.toFixed(2));

    var discount_value = total_vat / 100 * $("#InvoiceRow_discount").val();
    $("#InvoiceRow_discount_value").val(discount_value.toFixed(2));
    var total = total_vat - discount_value;
    $("#InvoiceRow_total").val(total.toFixed(2));

    var total_work_time = $("#InvoiceRow_work_time").val() * $("#InvoiceRow_quantity").val();
    $("#InvoiceRow_total_work_time").val(total_work_time.toFixed(2));

    return true;
}', CClientScript::POS_END); ?>
