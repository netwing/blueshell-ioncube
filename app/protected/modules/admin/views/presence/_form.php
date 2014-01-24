<?php
/* @var $this PresenceController */
/* @var $model Presence */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'presence-form',
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
        <?php echo $form->labelEx($model, 'presenza_posto_barca', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'presenza_posto_barca', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'presenza_posto_barca'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'presenza_cliente', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'presenza_cliente', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'presenza_cliente'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'presenza_barca', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'presenza_barca', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'presenza_barca'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'presenza_arrivo', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'presenza_arrivo', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'presenza_arrivo'); ?>
        <p class="help-block"><?php echo Yii::t('app', ''); ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'presenza_partenza', array('class' => 'col-lg-2 control-label')); ?>
        <div class="col-lg-10">
        <?php echo $form->textField($model, 'presenza_partenza', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'presenza_partenza'); ?>
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
