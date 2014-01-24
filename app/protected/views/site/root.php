<div class="jumbotron">
    <div class="container">
    <h1 class="text-danger"><?php echo Yii::t('app', 'Root login'); ?></h1>
        <p><?php echo Yii::t('app', "You have signed in with an administrative account that should be used only for special purposes, like users administration."); ?></p>
        <p><?php echo Yii::t('app', "Please, do not use this account for normal application management."); ?></p>
        <p><a class="btn btn-danger btn-lg" href="<?php echo $this->createUrl('/admin/user/admin'); ?>">Go to users administration</a></p>
    </div>
</div>

