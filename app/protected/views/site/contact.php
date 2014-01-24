<?php
/* @var $this ContractTypeController */
/* @var $model ContractType */

$this->pageTitle = Yii::t('app', 'Contact us');
$this->breadcrumbs=array(
	'Contact',
);

?>

<?php 
$this->beginClip('sidebar2'); 
$this->beginWidget('zii.widgets.CPortlet', array(
    'title' => '<strong>' . Yii::t('app', 'HELP US TO IMPROVE!') . '</strong>',
    'htmlOptions' => array('class' => 'panel panel-default'),
    'decorationCssClass' => 'panel-heading',
    'titleCssClass' => 'panel-title',
    'contentCssClass' => 'panel-body',
)); ?>
<p><?php echo Yii::t('app', "Our development team is always very responsive to requests that our clients ask us during use in order to continuously improve BlueShell and thus improve the management of your port."); ?></p>
<p><?php echo Yii::t('app', "We have always based the development of this software by listening to the demands of direct operators of ports and treasure in the development of new functionality in order to enrich more and more functions BlueShell, giving the opportunity to our customers to use a tool more and more dedicated to their needs."); ?>
<p><?php echo Yii::t('app', "If you'd like to report a request for a new feature or a change to an existing function, or you want to recommend to our team what features might be useful in our software, please fill out the form to the left."); ?>

<p><?php echo Yii::t('app', "Our development team will evaluate the request in order to be able to implement BlueShell."); ?></p>

<?php
$this->endWidget();
$this->endClip();
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contract-type-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
    'htmlOptions'=>array('class'=>'form-horizontal well'),
    'errorMessageCssClass' => 'text-danger'
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="form-group">
		<?php echo $form->labelEx($model,'name',  array('class' => 'col-lg-2 control-label')); ?>
		<div class="col-lg-10">
		<?php echo $form->textField($model,'name', array('class' => 'form-control')); ?>
		<?php echo $form->error($model,'name'); ?>
		</div>
	</div>

    <div class="form-group">
		<?php echo $form->labelEx($model,'email',  array('class' => 'col-lg-2 control-label')); ?>
		<div class="col-lg-10">
		<?php echo $form->textField($model,'email', array('class' => 'form-control')); ?>
		<?php echo $form->error($model,'email'); ?>
		</div>
	</div>

    <div class="form-group">
		<?php echo $form->labelEx($model,'subject',  array('class' => 'col-lg-2 control-label')); ?>
		<div class="col-lg-10">
		<?php echo $form->textField($model,'subject', array('class' => 'form-control', 'size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'subject'); ?>
		</div>
	</div>

    <div class="form-group">
		<?php echo $form->labelEx($model,'body',  array('class' => 'col-lg-2 control-label')); ?>
		<div class="col-lg-10">
		<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50, 'class' => 'form-control',)); ?>
		<?php echo $form->error($model,'body'); ?>
		</div>
	</div>

    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
            <div id="myDropZone" class="dropzone">
                <p><?php echo Yii::t('app', 'Drop here files'); ?></p>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
			<button type="submit" class="btn btn-primary"><?php echo Yii::t('app', 'Submit'); ?></button>
        </div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->


<?php Yii::app()->clientScript->registerCssFile('../css/dropzone.css'); ?>
<?php Yii::app()->clientScript->registerScriptFile('../bower_components/dropzone/downloads/dropzone.js'); ?>


<?php Yii::app()->clientScript->registerScript("dropzone-init", '
Dropzone.autoDiscover = false;
$("div#myDropZone").dropzone({ 
    init: function() {
        this.on("removedfile", function(file) { 
            $.get( "' . $this->createUrl('/site/contact') . '", { delete: file.name } );
        });
    },
    url: "' . $this->createUrl("/site/contact") . '", 
    paramName: "file",
    addRemoveLinks: true,
});

', CClientScript::POS_READY); ?>