<?php
/* @var $this OrderTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = Yii::t('app', 'Order Types');

$this->breadcrumbs=array(
	'Order Types',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage OrderType'), 'url'=>array('admin')),
    array('label'=>Yii::t('app', 'Create OrderType'), 'url'=>array('create')),
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
