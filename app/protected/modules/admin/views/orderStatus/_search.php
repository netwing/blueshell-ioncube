<?php
/* @var $this OrderStatusController */
/* @var $model OrderStatus */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
    'htmlOptions'=>array('class'=>'form-horizontal well'),
)); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'name', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'name', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'color', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'color', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'opened', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'opened', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'closed', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'closed', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cancelled', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'cancelled', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-4">
            <button type="submit" class="btn btn-primary"><?php echo Yii::t('app', 'Search'); ?></button>
        </div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->