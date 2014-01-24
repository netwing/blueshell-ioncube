<?php
/* @var $this OrderController */
/* @var $model Order */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
    'htmlOptions'=>array('class'=>'form-horizontal well'),
)); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'id', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'id', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'customer_id', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'customer_id', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'date', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'date', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'status_id', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'status_id', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'notes', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'notes', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'create_time', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'create_time', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'update_time', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'update_time', array('class' => 'form-control')); ?>        </div>
    </div>


    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-4">
            <button type="submit" class="btn btn-primary"><?php echo Yii::t('app', 'Search'); ?></button>
        </div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->