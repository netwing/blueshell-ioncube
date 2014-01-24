<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="<?php echo (isset(Yii::app()->language)) ? Yii::app()->language : 'en'; ?>" />
    <?php Yii::app()->bootstrap->register();  // Netwing Bootstrap ?>
    <?php Yii::app()->fontAwesome->register();  // Netwing Font Awesome ?>
    <?php Yii::app()->getClientScript()->registerCssFile('css/application.css'); ?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <style>
    #mainsearchresults {
        background-color: #FFF;
        border: 1px solid #CCC;
        border-radius: 5px;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        padding-left: 10px;
        padding-right: 10px;
        box-shadow: 0px 0px 5px black; 
        z-index: 1001;
    }
    </style>
</head>

<body>

<?php $this->renderPartial('//layouts/menu'); ?>

<div class="container" id="page">

    <?php if (count(Yii::app()->user->getFlashes(false)) > 0): ?>
    <div class="row">
        <div class="col-lg-12">
        <?php foreach (Yii::app()->user->getFlashes() as $k => $v): ?>
        <div class="alert alert-<?php echo $k; ?> alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $v; ?></div>
        <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
        
    <?php echo $content; ?>

<hr />
    <div class="row">
        <div class="col-xs-12 col-sm-4">
            <?php if (!Yii::app()->user->isGuest): ?>
            <a href="<?php echo $this->createUrl("/site/contact"); ?>"><?php echo Yii::t('app', 'Contact us'); ?></a>
            <?php endif; ?>
            <?php // $this->widget('ext.ELanguagePicker', array()); ?><br />
        </div>
        <div class="col-xs-12 col-sm-4 col-sm-push-4 text-right">
            <?php if (isset(Yii::app()->theme)): ?>
                <?php // $this->widget('ext.netwing.ThemePicker.EThemePicker', array()); ?>
            <?php endif; ?>
            <?php $this->widget('ext.ELanguagePicker', array()); ?>
            <br />
        </div>
        <div class="col-xs-12 col-sm-4 col-sm-pull-4" style="text-align: center">
            Copyright &copy; <?php echo date('Y'); ?> by Netwing SRL, All Rights Reserved. 
        </div>
    </div>
</div>

<!-- Container for search results -->
<div id="mainsearchresults" style="display: none" class="col-md-4">
    &nbsp;
</div>

<?php Yii::app()->clientScript->registerScript('main_search', '

/*
$.ajax({
    url:"rest/api/customer/5451",
    type:"GET",
    success:function(data) {
      console.log(data);
  },
  error:function (xhr, ajaxOptions, thrownError){
      console.log(xhr.responseText);
  } 
}); 
*/
var myAjax = undefined;
$("#topNavbarMainSearch").on("keyup", function() {
    var s = $("#topNavbarMainSearch").val();
    if (s.length >= 3) {
        if (myAjax !== undefined) {
            $("#mainsearchresults").html("").hide();
            myAjax.abort();
        }
        $("#mainsearchresults").position({
            my:        "right top",
            at:        "right bottom",
            of:        $("#topNavbar"),
            collision: "none"
        })        
        $("#mainsearchresults").html(\'<div style="text-align: center"><p><img src="images/loading.gif" alt="loading..." /></p></div>\').show();
        myAjax = $.ajax({
            url: "../mainsearch.php",
            quietMillis: 500,
            data: {"s": s}
        }).done(function ( data ) {
            $("#mainsearchresults").position({
                my:        "right top",
                at:        "right bottom",
                of:        $("#topNavbar"),
                collision: "none"
            })        
            $("#mainsearchresults").html(data).show();
        });        
    } else {
        $("#mainsearchresults").html("").hide();
    }
})
$("#topNavbarMainSearchReset").on("click", function() {
    if (myAjax !== undefined) {
        myAjax.abort();
    }
    $("#topNavbarMainSearch").val("");
    $("#mainsearchresults").html("").hide();
    return false;
})
');?>

    <?php Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' ); ?>

</body>
</html>
