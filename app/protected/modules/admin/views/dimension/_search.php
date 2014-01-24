<?php
/* @var $this DimensionController */
/* @var $model Dimension */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
    'htmlOptions'=>array('class'=>'form-horizontal well'),
)); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'dimensione_id', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'dimensione_id', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'dimensione_lunghezza', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'dimensione_lunghezza', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'dimensione_larghezza', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'dimensione_larghezza', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'dimensione_profondita', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'dimensione_profondita', array('class' => 'form-control')); ?>        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'dimensione_tipo', array('class' => 'col-lg-2 control-label')); ?>        <div class="col-lg-4">
        <?php echo $form->textField($model, 'dimensione_tipo', array('class' => 'form-control')); ?>        </div>
    </div>


    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-4">
            <button type="submit" class="btn btn-primary"><?php echo Yii::t('app', 'Search'); ?></button>
        </div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->