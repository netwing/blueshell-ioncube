<?php
/* @var $this CustomerController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = Yii::t('app', 'Customers');

$this->breadcrumbs=array(
	'Customers',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage Customer'), 'url'=>array('admin')),
    array('label'=>Yii::t('app', 'Create Customer'), 'url'=>array('create')),
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
