<?php
/* @var $this ProductController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = Yii::t('app', 'Products');

$this->breadcrumbs=array(
	'Products',
);

$this->menu=array(
    array('label'=>'Manage Product', 'url'=>array('admin')),
    array('label'=>'Create Product', 'url'=>array('create')),
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
