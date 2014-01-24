<?php
/* @var $this InvoiceController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = Yii::t('app', 'Invoices');

$this->breadcrumbs=array(
	'Invoices',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage Invoice'), 'url'=>array('admin')),
    array('label'=>Yii::t('app', 'Create Invoice'), 'url'=>array('create')),
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
