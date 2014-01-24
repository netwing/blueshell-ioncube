<?php $this->pageTitle = ""; ?>

<div style="margin-bottom: 15px">
    <a href="<?php echo Yii::app()->getHomeUrl(); ?>"><img src="../images/login.png" alt="BlueShell Login" class="img-responsive" style="margin: 0 auto" /></a>
</div>

<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'login-form',
    'enableClientValidation'=>false,
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('class' => 'form-signin well'),
    'errorMessageCssClass' => 'text-danger'
)); ?>

    <div class="form-group">
        <?php // echo $form->labelEx($model,'username', array('class' => 'control-label')); ?>
        <?php echo $form->textField($model,'username', array('class' => 'form-control', 'placeholder' => Yii::t('app', 'Username'))); ?>
        <?php echo $form->error($model,'username'); ?>
        <?php // echo $form->labelEx($model,'password', array('class' => 'control-label')); ?>
        <?php echo $form->passwordField($model,'password', array('class' => 'form-control', 'placeholder' => Yii::t('app', 'Password'))); ?>
        <?php echo $form->error($model,'password'); ?>
    </div>

    <div class="form-group">
        <div class="checkbox">
        <?php echo $form->checkBox($model, 'rememberMe'); ?>
        <?php echo $form->labelEx($model, 'rememberMe'); ?>
        </div>
    </div>
    
    <div class="form-group">
        <button type="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
    </div>

<?php $this->endWidget(); ?>

<?php Yii::app()->clientScript->registerCss('login_css', 
'.form-signin {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}

.form-signin-heading {
    text-align: center;
}

.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  font-size: 16px;
  height: auto;
  padding: 10px;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="text"] {
  margin-bottom: -1px;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
'); ?>

