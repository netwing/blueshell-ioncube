<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/pdf'); ?>

<div class="row-fluid">
    <div class="span12">
        <h2><?php echo $this->pageTitle; ?></h2>
    </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <?php echo $content; ?>
    </div>
</div>

<?php $this->endContent(); ?>