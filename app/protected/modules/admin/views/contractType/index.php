<?php
/* @var $this ContractTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = Yii::t('app', 'Contract Types');

$this->breadcrumbs=array(
	'Contract Types',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage ContractType'), 'url'=>array('admin')),
    array('label'=>Yii::t('app', 'Create ContractType'), 'url'=>array('create')),
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
