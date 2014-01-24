<?php
/* @var $this InvoiceController */
/* @var $model Invoice */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'invoice-form',
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

        <div class="col-md-6">
        <?php echo $form->labelEx($model, 'customer_id', array('class' => 'control-label')); ?>
        <?php echo $form->textField($model, 'customer_id', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'customer_id'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

        <div class="col-md-3">
        <?php echo $form->labelEx($model, 'status_id', array('class' => 'control-label')); ?>
        <?php echo $form->dropDownList($model, 'status_id', CHtml::listData(InvoiceStatus::model()->findAll(array('order' => 'sort_order ASC, name ASC')), 'id', 'name'), array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'status_id'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

        <div class="col-md-3">
        <?php echo $form->labelEx($model, 'type_id', array('class' => 'control-label')); ?>
        <?php echo $form->dropDownList($model, 'type_id', CHtml::listData(InvoiceType::model()->findAll(array('order' => 'sort_order ASC, name ASC')), 'id', 'name'), array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'type_id'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

    </div>
    
    <div class="form-group">

        <div class="col-md-4">
        <?php echo $form->labelEx($model, 'date', array('class' => 'control-label')); ?>
        <?php $datepicker = $this->widget('ext.netwing.widgets.JuiDatePicker', array(
            'htmlOptions' => array('class' => 'form-control'),
            'model' => $model,
            'attribute' => 'date',
        )); ?>
        <?php echo $form->error($model,'date'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

        <div class="col-md-4">
        <?php echo $form->labelEx($model, 'due_date', array('class' => 'control-label')); ?>
        <?php $datepicker = $this->widget('ext.netwing.widgets.JuiDatePicker', array(
            'htmlOptions' => array('class' => 'form-control'),
            'model' => $model,
            'attribute' => 'due_date',
        )); ?>
        <?php echo $form->error($model,'due_date'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

        <div class="col-md-4">
        <?php echo $form->labelEx($model, 'date_paid', array('class' => 'control-label')); ?>
        <?php $datepicker = $this->widget('ext.netwing.widgets.JuiDatePicker', array(
            'htmlOptions' => array('class' => 'form-control'),
            'model' => $model,
            'attribute' => 'date_paid',
        )); ?>
        <?php echo $form->error($model,'date_paid'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

    </div>

    <?php // Billing part of invoice ?>
    <div class="form-group">

        <div class="col-md-4">
        <?php echo $form->labelEx($model, 'billing_header', array('class' => 'control-label')); ?>
        <?php echo $form->textField($model, 'billing_header', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'billing_header'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

        <div class="col-md-4">
        <?php echo $form->labelEx($model, 'billing_address', array('class' => 'control-label')); ?>
        <?php echo $form->textField($model, 'billing_address', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'billing_address'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

        <div class="col-md-4">
        <?php echo $form->labelEx($model, 'billing_tax', array('class' => 'control-label')); ?>
        <?php echo $form->textField($model, 'billing_tax', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'billing_tax'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

    </div>

    <div class="form-group">

        <div class="col-md-3">
        <?php echo $form->labelEx($model, 'billing_zip', array('class' => 'control-label')); ?>
        <?php echo $form->textField($model, 'billing_zip', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'billing_zip'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

        <div class="col-md-3">
        <?php echo $form->labelEx($model, 'billing_city', array('class' => 'control-label')); ?>
        <?php echo $form->textField($model, 'billing_city', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'billing_city'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

        <div class="col-md-3">
        <?php echo $form->labelEx($model, 'billing_province', array('class' => 'control-label')); ?>
        <?php echo $form->textField($model, 'billing_province', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'billing_province'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

        <div class="col-md-3">
        <?php echo $form->labelEx($model, 'billing_country', array('class' => 'control-label')); ?>
        <?php echo $form->textField($model, 'billing_country', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'billing_country'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

    </div>

    <?php // Shipping part of invoice ?>
    <div class="form-group">

        <div class="col-md-4">
        <?php echo $form->labelEx($model, 'shipping_header', array('class' => 'control-label')); ?>
        <?php echo $form->textField($model, 'shipping_header', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'shipping_header'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

        <div class="col-md-4">
        <?php echo $form->labelEx($model, 'shipping_address', array('class' => 'control-label')); ?>
        <?php echo $form->textField($model, 'shipping_address', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'shipping_address'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

    </div>

    <div class="form-group">

        <div class="col-md-3">
        <?php echo $form->labelEx($model, 'shipping_zip', array('class' => 'control-label')); ?>
        <?php echo $form->textField($model, 'shipping_zip', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'shipping_zip'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

        <div class="col-md-3">
        <?php echo $form->labelEx($model, 'shipping_city', array('class' => 'control-label')); ?>
        <?php echo $form->textField($model, 'shipping_city', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'shipping_city'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

        <div class="col-md-3">
        <?php echo $form->labelEx($model, 'shipping_province', array('class' => 'control-label')); ?>
        <?php echo $form->textField($model, 'shipping_province', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'shipping_province'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

        <div class="col-md-3">
        <?php echo $form->labelEx($model, 'shipping_country', array('class' => 'control-label')); ?>
        <?php echo $form->textField($model, 'shipping_country', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'shipping_country'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

    </div>


    <div class="form-group">

        <div class="col-lg-6">
        <?php echo $form->labelEx($model, 'payment_method', array('class' => 'control-label')); ?>
        <?php echo $form->textField($model, 'payment_method', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'payment_method'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

        <div class="col-lg-6">
        <?php echo $form->labelEx($model, 'notes', array('class' => 'control-label')); ?>
        <?php echo $form->textarea($model, 'notes', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'notes'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

    </div>

    <div class="form-group">
        <div class="col-lg-12 text-center">
            <button type="reset" class="btn btn-warning">Reset</button>
            <button type="submit" class="btn btn-primary"><?php echo ($model->isNewRecord) ? Yii::t('app', 'Create') : Yii::t('app', 'Save'); ?></button>
        </div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->


<?php Yii::app()->select2->register(); ?>
<?php Yii::app()->clientScript->registerScript('invoice_customer_id_init',
'
$("#Invoice_customer_id").select2({
        placeholder: "' . Yii::t('app', 'Search for a client') . '",
        minimumInputLength: 3,
        ajax: { 
            url: "../json.php?s=clients&format=select2",
            dataType: "json",
            quietMillis: 100,
            data: function (term, page) {
                return {
                    q: term, // search term
                    page_limit: 10,
                    page: page,
                };
            },
            results: function (data, page) {
                var more = (page * 10) < data.total; // whether or not there are more results available
                // notice we return the value of more so Select2 knows if more results can be loaded
                return {results: data.results, more: more};
            },
        },
        initSelection: function (element, callback) {
            var id = $(element).val();
            if (id!=="") {
                $.ajax("../json.php?s=client&format=select2&id=" + id, {
                    data: {},
                    dataType: "json"
                }).done(function(data) { callback(data); });
            }
        },
        escapeMarkup: function (m) { return m; }
}).on("change", function(e) {
    $("#Invoice_billing_address").val("' . Yii::t("app", "Please wait...") . '");
    $.ajax("../json.php?s=client&id=" + e.val, {
        dataType: "json"
    }).done(function(data) { 
        $("#Invoice_billing_header").val(data.cliente_nominativo);
        $("#Invoice_billing_address").val(data.cliente_indirizzo);
        $("#Invoice_billing_zip").val(data.cliente_cap);
        $("#Invoice_billing_city").val(data.cliente_citta);
        $("#Invoice_billing_province").val(data.cliente_provincia);
        $("#Invoice_billing_country").val(data.cliente_nazione_nome);
        if (data.cliente_partita_iva != "") {
            $("#Invoice_billing_tax").val(data.cliente_partita_iva);
        } else {
            $("#Invoice_billing_tax").val(data.cliente_codice_fiscale);
        }
        $("#Invoice_shipping_header").val(data.cliente_nominativo);
        $("#Invoice_shipping_address").val(data.cliente_indirizzo);
        $("#Invoice_shipping_zip").val(data.cliente_cap);
        $("#Invoice_shipping_city").val(data.cliente_citta);
        $("#Invoice_shipping_province").val(data.cliente_provincia);
        $("#Invoice_shipping_country").val(data.cliente_nazione_nome);
    });
});
', CClientScript::POS_READY); ?>