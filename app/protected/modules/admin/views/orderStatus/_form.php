<?php
/* @var $this OrderStatusController */
/* @var $model OrderStatus */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'order-status-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableClientValidation'=>false,
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('class'=>'form-horizontal well'),
    'errorMessageCssClass' => 'text-danger'
)); ?>

    <p class="help-block"><?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.'); ?>
</p>

    <?php echo $form->errorSummary($model, null, null, array('class' => 'text-danger')); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'name', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'name', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'name'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

   <div class="form-group">
        <?php echo $form->labelEx($model, 'quote', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <label class="radio-inline">
            <?php echo $form->radioButton($model, 'quote', array('value' => 1, 'uncheckValue' => null)); ?> <?php echo Yii::t('app', 'Yes'); ?>
        </label>
        <label class="radio-inline">
            <?php echo $form->radioButton($model, 'quote', array('value' => 0, 'uncheckValue' => null)); ?> <?php echo Yii::t('app', 'No'); ?>
        </label>
        <?php echo $form->error($model,'quote'); ?>
        <p class="help-block"><?php echo Yii::t('app', 'Set to "yes" if orders in this state should appear as a quote'); ?></p>
        </div>
    </div>

   <div class="form-group">
        <?php echo $form->labelEx($model, 'opened', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <label class="radio-inline">
            <?php echo $form->radioButton($model, 'opened', array('value' => 1, 'uncheckValue' => null)); ?> <?php echo Yii::t('app', 'Yes'); ?>
        </label>
        <label class="radio-inline">
            <?php echo $form->radioButton($model, 'opened', array('value' => 0, 'uncheckValue' => null)); ?> <?php echo Yii::t('app', 'No'); ?>
        </label>
        <?php echo $form->error($model,'opened'); ?>
        <p class="help-block"><?php echo Yii::t('app', 'Set to "yes" if orders in this state should appear "opened"'); ?></p>
        </div>
    </div>

   <div class="form-group">
        <?php echo $form->labelEx($model, 'pending', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <label class="radio-inline">
            <?php echo $form->radioButton($model, 'pending', array('value' => 1, 'uncheckValue' => null)); ?> <?php echo Yii::t('app', 'Yes'); ?>
        </label>
        <label class="radio-inline">
            <?php echo $form->radioButton($model, 'pending', array('value' => 0, 'uncheckValue' => null)); ?> <?php echo Yii::t('app', 'No'); ?>
        </label>
        <?php echo $form->error($model,'pending'); ?>
        <p class="help-block"><?php echo Yii::t('app', 'Set to "yes" if orders in this state should appear pending (to do for your staff)'); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'closed', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <label class="radio-inline">
            <?php echo $form->radioButton($model, 'closed', array('value' => 1, 'uncheckValue' => null)); ?> <?php echo Yii::t('app', 'Yes'); ?>
        </label>
        <label class="radio-inline">
            <?php echo $form->radioButton($model, 'closed', array('value' => 0, 'uncheckValue' => null)); ?> <?php echo Yii::t('app', 'No'); ?>
        </label>
        <?php echo $form->error($model,'closed'); ?>
        <p class="help-block"><?php echo Yii::t('app', 'Set to "yes" if orders in this state should appear "closed"'); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cancelled', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <label class="radio-inline">
            <?php echo $form->radioButton($model, 'cancelled', array('value' => 1, 'uncheckValue' => null)); ?> <?php echo Yii::t('app', 'Yes'); ?>
        </label>
        <label class="radio-inline">
            <?php echo $form->radioButton($model, 'cancelled', array('value' => 0, 'uncheckValue' => null)); ?> <?php echo Yii::t('app', 'No'); ?>
        </label>
        <?php echo $form->error($model,'cancelled'); ?>
        <p class="help-block"><?php echo Yii::t('app', 'Set to "yes" if orders in this state should appear "cancelled"'); ?></p>
        </div>
    </div>

    <div class="form-group">

        <?php echo $form->labelEx($model, 'color', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-4">
        <?php echo $form->textField($model, 'color', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'color'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>

        <?php echo $form->labelEx($model, 'sort_order', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-4">
        <?php echo $form->textField($model, 'sort_order', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'sort_order'); ?>
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
<?php Yii::app()->clientScript->registerScript('OrderStatus_color_minicolor', '
$("#OrderStatus_color").minicolors("create", {
        defaultValue    : "' . $model->color . '",
        theme           : "bootstrap",
    });
', CClientScript::POS_READY); ?>
