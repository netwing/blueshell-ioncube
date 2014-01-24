<?php
/* @var $this SystemTemplateController */
/* @var $model SystemTemplate */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'system-template-form',
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
        <?php echo $form->labelEx($model, 'name', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-4">
        <?php echo $form->textField($model, 'name', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'name'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

        <?php if ($model->isNewRecord): ?>

        <?php echo $form->labelEx($model, 'language', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-4">
        <?php echo $form->dropDownList($model, 'language', 
                    $languages, 
                    array('class' => 'form-control disabled')); 
        ?>
        <?php echo $form->error($model,'language'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

        <?php else: ?>

        <?php echo $form->labelEx($model, 'language', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-4">
        <?php echo $form->dropDownList($model, 'language', 
                    ELanguagePicker::getSimpleLanguageList(), 
                    array('class' => 'form-control disabled', 'disabled' => 'disabled', 'readonly' => 'readonly')); 
        ?>
        <?php echo $form->error($model,'language'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

        <?php endif; ?>

    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'description', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'description', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'description'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'text_content', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textarea($model, 'text_content', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'text_content'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'html_content', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textarea($model, 'html_content', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'html_content'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

<?php Yii::app()->clientScript->registerScriptFile("../js/tinymce/js/tinymce/tinymce.min.js"); ?>
<?php Yii::app()->clientScript->registerScript('tinymce_init',
'
tinymce.init({
    height: 500,
    cleanup_on_startup: false,
    trim_span_elements: false,
    verify_html: false,
    cleanup: false,
    convert_urls: false,
    selector: "textarea#SystemTemplate_html_content",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect sizeselect | fontselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
 });
', 
CClientScript::POS_READY); ?>

    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
            <button type="reset" class="btn btn-warning">Reset</button>
            <a href="<?php echo $this->createUrl('preview', array('id' => $model->id, 'language' => $model->language)); ?>" class="btn btn-warning" target="_blank"><?php echo Yii::t('app', 'Preview template'); ?></a>
            <button type="submit" class="btn btn-primary"><?php echo ($model->isNewRecord) ? Yii::t('app', 'Create') : Yii::t('app', 'Save'); ?></button>
        </div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
