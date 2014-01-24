<?php
/* @var $this ProductGroupController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = Yii::t('app', 'Product Groups');

$this->breadcrumbs=array(
	'Product Groups',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage ProductGroup'), 'url'=>array('admin')),
    array('label'=>Yii::t('app', 'Create ProductGroup'), 'url'=>array('create')),
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
