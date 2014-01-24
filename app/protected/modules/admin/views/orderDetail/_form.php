<?php
/* @var $this OrderDetailController */
/* @var $model OrderDetail */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'order-detail-form',
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
        <?php echo $form->labelEx($model, 'product_id', array('class' => 'col-md-2 control-label')); ?>
        <div class="col-md-10">
        <?php echo $form->textField($model, 'product_id', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'product_id'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <?php Yii::app()->select2->register(); ?>
    <?php Yii::app()->clientScript->registerScript('product_script',
    '$("#OrderDetail_product_id").select2({
            placeholder: "' . Yii::t('app', 'Search for a product or service') . '",
            // minimumInputLength: 3,
            ajax: { 
                url: "../json.php?s=products&format=select2",
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
                    $.ajax("../json.php?s=product&format=select2&id=" + id, {
                        data: {},
                        dataType: "json"
                    }).done(function(data) { callback(data); });
                }
            },
            escapeMarkup: function (m) { return m; }
    }).on("change", function(e) { 
        var myProductUrl = "../json.php?s=productDetail";
        $.getJSON(myProductUrl, {id: e.val})
        .done(function (data) {
            $("#OrderDetail_price").val(data.price);
            $("#OrderDetail_quantity").val("1.00");
            $("label[for=\'OrderDetail_quantity\']").html(data.measure_unit + \'<span class="required">*</span>\');
            $("#OrderDetail_discount").val("0");
            $("#OrderDetail_discount_value").val("0.00");
            $("#OrderDetail_vat").val(data.vat);
            $("#OrderDetail_work_time").val(data.work_time);
            calcTotal($("OrderDetail_price"));
        })
        .fail(function( jqxhr, textStatus, error ) {
            var err = textStatus + ", " + error;
            console.log( "Request Failed: " + err );
        })
    });', CClientScript::POS_READY); ?>

    <?php Yii::app()->clientScript->registerScript('form_functions',
    'function calcTotal(e) {

        // Calc total_no_vat
        var price = $("#OrderDetail_price").val();
        var quantity = $("#OrderDetail_quantity").val();
        var total_no_vat = (price * quantity);
        $("#OrderDetail_total_no_vat").val(total_no_vat.toFixed(2));

        var vat = $("#OrderDetail_vat").val();
        var vat_value = ((total_no_vat / 100) * vat);
        var total_vat = (total_no_vat + vat_value);
        $("#OrderDetail_vat_value").val(vat_value.toFixed(2));
        $("#OrderDetail_total_vat").val(total_vat.toFixed(2));

        // Total before discount
        $("#OrderDetail_total").val(total_vat.toFixed(2));

        // Calc discount_value / discount from (total - discount) or (total - discount_value)
        if (e.id == "OrderDetail_discount_value") {
            var discount_value = $("#OrderDetail_discount_value").val();
            var discount = 100 * discount_value / $("#OrderDetail_total_vat").val();
            $("#OrderDetail_discount").val(discount.toFixed(3));
        } else {
            var discount_value = total_vat / 100 * $("#OrderDetail_discount").val();
            $("#OrderDetail_discount_value").val(discount_value.toFixed(2));
        }

        // Real total with discount
        var total = total_vat - discount_value;
        $("#OrderDetail_total").val(total.toFixed(2));

        // Calc total work time
        var total_work_time = $("#OrderDetail_work_time").val() * $("#OrderDetail_quantity").val();
        $("#OrderDetail_total_work_time").val(total_work_time.toFixed(2));

        return true;
    }', CClientScript::POS_END); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'price', array('class' => 'col-md-2 control-label')); ?>
        <div class="col-md-2">
        <?php echo $form->textField($model, 'price', array('class' => 'form-control', 'onkeyup' => 'calcTotal(this);')); ?>
        <?php echo $form->error($model,'price'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

        <?php echo $form->labelEx($model, 'quantity', array('class' => 'col-md-2 control-label')); ?>
        <div class="col-md-2">
        <?php echo $form->textField($model, 'quantity', array('class' => 'form-control', 'onkeyup' => 'calcTotal(this);')); ?>
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
        <?php echo $form->textField($model, 'vat', array('class' => 'form-control', 'onkeyup' => 'calcTotal(this);')); ?>
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
        <?php echo $form->textField($model, 'total_vat', array('class' => 'form-control', 'readonly' => 'readonly')); ?>
        <?php echo $form->error($model,'total_vat'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'discount', array('class' => 'col-md-2 control-label')); ?>
        <div class="col-md-2">
        <?php echo $form->textField($model, 'discount', array('class' => 'form-control', 'onkeyup' => 'calcTotal(this);')); ?>
        <?php echo $form->error($model,'discount'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

        <?php echo $form->labelEx($model, 'discount_value', array('class' => 'col-md-2 control-label')); ?>
        <div class="col-md-2">
        <?php echo $form->textField($model, 'discount_value', array('class' => 'form-control', 'onkeyup' => 'calcTotal(this);')); ?>
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

        <?php echo $form->labelEx($model, 'work_time', array('class' => 'col-md-2 control-label')); ?>
        <div class="col-md-4">
        <?php echo $form->textField($model, 'work_time', array('class' => 'form-control', 'onkeyup' => 'calcTotal(this);')); ?>
        <?php echo $form->error($model,'work_time'); ?>
        <p class="help-block"><?php echo Yii::t('app', 'Work time for 1 single unit.'); ?></p>
        </div>

        <?php echo $form->labelEx($model, 'total_work_time', array('class' => 'col-md-2 control-label')); ?>
        <div class="col-md-4">
        <?php echo $form->textField($model, 'total_work_time', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'total_work_time'); ?>
        <p class="help-block"><?php echo Yii::t('app', 'Total work time.'); ?></p>
        </div>

    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'done', array('class' => 'col-md-2 control-label')); ?>
        <div class="col-md-10">
        <label class="radio-inline">
            <?php echo $form->radioButton($model, 'done', array('value' => 1, 'uncheckValue' => null)); ?> <?php echo Yii::t('app', 'Yes'); ?>
        </label>
        <label class="radio-inline">
            <?php echo $form->radioButton($model, 'done', array('value' => 0, 'uncheckValue' => null)); ?> <?php echo Yii::t('app', 'No'); ?>
        </label>
        <?php echo $form->error($model,'done'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'notes', array('class' => 'col-md-2 control-label')); ?>
        <div class="col-md-10">
        <?php echo $form->textArea($model, 'notes', array('class' => 'form-control')); ?>
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
