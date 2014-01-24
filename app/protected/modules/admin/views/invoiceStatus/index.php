<?php
/* @var $this InvoiceStatusController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = Yii::t('app', 'Invoice Statuses');

$this->breadcrumbs=array(
	'Invoice Statuses',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage InvoiceStatus'), 'url'=>array('admin')),
    array('label'=>Yii::t('app', 'Create InvoiceStatus'), 'url'=>array('create')),
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
