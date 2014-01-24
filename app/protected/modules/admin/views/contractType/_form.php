<?php
/* @var $this ContractTypeController */
/* @var $model ContractType */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contract-type-form',
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
        <?php echo $form->labelEx($model, 'contratto_tipo_nome', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'contratto_tipo_nome', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'contratto_tipo_nome'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">

        <?php echo $form->labelEx($model, 'color', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-4">
        <?php echo $form->textField($model, 'color', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'color'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

        <?php echo $form->labelEx($model, 'prefix', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-4">
        <?php echo $form->textField($model, 'prefix', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'prefix'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

    </div>

    <div class="form-group">

        <?php echo $form->labelEx($model, 'rent', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-4">
        <label class="radio-inline">
            <?php echo $form->radioButton($model, 'rent', array('value' => 1, 'uncheckValue' => null)); ?> <?php echo Yii::t('app', 'Yes'); ?>
        </label>
        <label class="radio-inline">
            <?php echo $form->radioButton($model, 'rent', array('value' => 0, 'uncheckValue' => null)); ?> <?php echo Yii::t('app', 'No'); ?>
        </label>
        <?php echo $form->error($model,'rent'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>   

        <?php echo $form->labelEx($model, 'transit', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-4">
        <label class="radio-inline">
            <?php echo $form->radioButton($model, 'transit', array('value' => 1, 'uncheckValue' => null)); ?> <?php echo Yii::t('app', 'Yes'); ?>
        </label>
        <label class="radio-inline">
            <?php echo $form->radioButton($model, 'transit', array('value' => 0, 'uncheckValue' => null)); ?> <?php echo Yii::t('app', 'No'); ?>
        </label>
        <?php echo $form->error($model,'transit'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>   

    </div>

    <div class="form-group">

        <?php echo $form->labelEx($model, 'sell', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-4">
        <label class="radio-inline">
            <?php echo $form->radioButton($model, 'sell', array('value' => 1, 'uncheckValue' => null)); ?> <?php echo Yii::t('app', 'Yes'); ?>
        </label>
        <label class="radio-inline">
            <?php echo $form->radioButton($model, 'sell', array('value' => 0, 'uncheckValue' => null)); ?> <?php echo Yii::t('app', 'No'); ?>
        </label>
        <?php echo $form->error($model,'sell'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>   

        <?php echo $form->labelEx($model, 'option', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-4">
        <label class="radio-inline">
            <?php echo $form->radioButton($model, 'option', array('value' => 1, 'uncheckValue' => null)); ?> <?php echo Yii::t('app', 'Yes'); ?>
        </label>
        <label class="radio-inline">
            <?php echo $form->radioButton($model, 'option', array('value' => 0, 'uncheckValue' => null)); ?> <?php echo Yii::t('app', 'No'); ?>
        </label>
        <?php echo $form->error($model,'option'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>   

    </div>

    <div class="form-group">

        <?php echo $form->labelEx($model, 'manage', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-4">
        <label class="radio-inline">
            <?php echo $form->radioButton($model, 'manage', array('value' => 1, 'uncheckValue' => null)); ?> <?php echo Yii::t('app', 'Yes'); ?>
        </label>
        <label class="radio-inline">
            <?php echo $form->radioButton($model, 'manage', array('value' => 0, 'uncheckValue' => null)); ?> <?php echo Yii::t('app', 'No'); ?>
        </label>
        <?php echo $form->error($model,'manage'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>   

        <?php echo $form->labelEx($model, 'reservation', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-4">
        <label class="radio-inline">
            <?php echo $form->radioButton($model, 'reservation', array('value' => 1, 'uncheckValue' => null)); ?> <?php echo Yii::t('app', 'Yes'); ?>
        </label>
        <label class="radio-inline">
            <?php echo $form->radioButton($model, 'reservation', array('value' => 0, 'uncheckValue' => null)); ?> <?php echo Yii::t('app', 'No'); ?>
        </label>
        <?php echo $form->error($model,'reservation'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>   

    </div>


    <div class="form-group">

        <?php echo $form->labelEx($model, 'sort_order', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'sort_order', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'sort_order'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

        <?php echo $form->labelEx($model, 'enabled', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-4">
        <label class="radio-inline">
            <?php echo $form->radioButton($model, 'enabled', array('value' => 1, 'uncheckValue' => null)); ?> <?php echo Yii::t('app', 'Yes'); ?>
        </label>
        <label class="radio-inline">
            <?php echo $form->radioButton($model, 'enabled', array('value' => 0, 'uncheckValue' => null)); ?> <?php echo Yii::t('app', 'No'); ?>
        </label>
        <?php echo $form->error($model,'enabled'); ?>
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

<?php Yii::app()->minicolors->register(); ?>
<?php Yii::app()->clientScript->registerScript('ContractType_color_minicolor', '
$("#ContractType_color").minicolors("create", {
        defaultValue    : "' . $model->color . '",
        theme           : "bootstrap",
    });
', CClientScript::POS_READY); ?>