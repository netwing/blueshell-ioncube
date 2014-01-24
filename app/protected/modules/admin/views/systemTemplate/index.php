<?php
/* @var $this SystemTemplateController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = Yii::t('app', 'System Templates');

$this->breadcrumbs=array(
	'System Templates',
);

$this->menu=array(
    array('label'=>Yii::t('app', 'Manage SystemTemplate'), 'url'=>array('admin')),
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
