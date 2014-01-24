<?php
/* @var $this OrderController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = Yii::t('app', 'Orders');

$this->breadcrumbs=array(
	'Orders',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage Order'), 'url'=>array('admin')),
    array('label'=>Yii::t('app', 'Create Order'), 'url'=>array('create')),
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
