<?php
/* @var $this InvoiceTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = Yii::t('app', 'Invoice Types');

$this->breadcrumbs=array(
	'Invoice Types',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage InvoiceType'), 'url'=>array('admin')),
    array('label'=>Yii::t('app', 'Create InvoiceType'), 'url'=>array('create')),
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
