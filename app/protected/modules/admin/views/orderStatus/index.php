<?php
/* @var $this OrderStatusController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = Yii::t('app', 'Order Statuses');

$this->breadcrumbs=array(
	'Order Statuses',
);

$this->menu=array(
    array('label'=>'Manage OrderStatus', 'url'=>array('admin')),
    array('label'=>'Create OrderStatus', 'url'=>array('create')),
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
