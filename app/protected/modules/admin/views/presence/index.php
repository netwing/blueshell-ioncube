<?php
/* @var $this PresenceController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = Yii::t('app', 'Presences');

$this->breadcrumbs=array(
	'Presences',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage Presence'), 'url'=>array('admin')),
    array('label'=>Yii::t('app', 'Create Presence'), 'url'=>array('create')),
);
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
    'pagerCssClass'     => "col-md-12 text-right",
    'pager'             => array(
        'header'                => '',
        'internalPageCssClass'  => '',
        'firstPageCssClass'     => '',
        'lastPageCssClass'      => '',
        'selectedPageCssClass'  => 'active',
        'htmlOptions'   => array(
            'class'     => 'pagination pagination-sm',
        )
    )

)); ?>
