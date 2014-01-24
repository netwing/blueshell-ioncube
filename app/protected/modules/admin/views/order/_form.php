<?php
/* @var $this OrderController */
/* @var $model Order */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'order-form',
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
        <?php echo $form->labelEx($model, 'customer_id', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'customer_id', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'customer_id'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <?php Yii::app()->select2->register(); ?>
    <?php Yii::app()->clientScript->registerScript('order_customer_id_init',
    '
    $("#Order_vector_id").attr("readonly", true);
    $("#Order_customer_id").select2({
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
            $("#Order_vector_id").attr("readonly", false);
            $("#Order_vector_id").select2({
                placeholder: "' . Yii::t("app", 'Search for a vector') . '",
                minimumInputLength: 0,
                ajax: {
                    url: "../json.php?s=client_vectors&format=select2&first_null=1",
                    dataType: "json",
                    quietMillis: 100,
                    data: function (term, page) {
                        return {
                            client: e.val
                        };
                    },
                    results: function (data, page) {
                        return {results: data.results, more: false};
                    },
                },
                escapeMarkup: function (m) { return m; }
            }); 

        });
', CClientScript::POS_READY); ?>

<?php 
if (!$model->isNewRecord) {
    Yii::app()->clientScript->registerScript('order_vector_id_init',
    '
    $("#Order_vector_id").attr("readonly", false);
    $("#Order_vector_id").select2({
            placeholder: "' . Yii::t('app', 'Search for a vector') . '",
            minimumInputLength: 0,
            ajax: { 
                url: "../json.php?s=client_vectors&format=select2&first_null=1",
                dataType: "json",
                quietMillis: 100,
                data: function (term, page) {
                    return {
                        client: $("#Order_customer_id").val()
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
                    $.ajax("../json.php?s=vector&format=select2&id=" + id, {
                        data: {},
                        dataType: "json"
                    }).done(function(data) { callback(data); });
                }
            },
            escapeMarkup: function (m) { return m; }
    });    
', CClientScript::POS_READY);
}
?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'vector_id', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'vector_id', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'vector_id'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'date', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-2">
        <?php $datepicker = $this->widget('ext.netwing.widgets.JuiDatePicker', array(
            'htmlOptions' => array('class' => 'form-control'),
            'model' => $model,
            'attribute' => 'date',
        )); ?>
        <?php echo $form->error($model,'date'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

        <?php echo $form->labelEx($model, 'work_date', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-2">
        <?php $datepicker = $this->widget('ext.netwing.widgets.JuiDatePicker', array(
            'htmlOptions' => array('class' => 'form-control'),
            'model' => $model,
            'attribute' => 'work_date',
        )); ?>
        <?php echo $form->error($model,'work_date'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
        <?php echo $form->labelEx($model, 'due_date', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-2">
        <?php $datepicker = $this->widget('ext.netwing.widgets.JuiDatePicker', array(
            'htmlOptions' => array('class' => 'form-control'),
            'model' => $model,
            'attribute' => 'due_date',
        )); ?>
        <?php echo $form->error($model,'due_date'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">

        <?php echo $form->labelEx($model, 'status_id', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-4">
        <?php echo $form->dropDownList($model, 'status_id', CHtml::listData(OrderStatus::model()->findAll(array('order' => 'sort_order ASC, name ASC')), 'id', 'name'), array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'status_id'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

        <?php echo $form->labelEx($model, 'work_number', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-4">
        <?php echo $form->textField($model, 'work_number', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'work_number'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'notes', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textArea($model, 'notes', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'notes'); ?>
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
