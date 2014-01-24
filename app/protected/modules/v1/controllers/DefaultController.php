<?php

class DefaultController extends SoapController
{

    /**
     * Define action handled by CWebServiceAction
     */
    public function actions()
    {
        return array(
            'index'=>array(
                'class'=>'CWebServiceAction',
            ),
        );
    }
 
    /** 
     * @return array of soap url
     * @soap
     */
    public function index()
    {   
        return array(
            'alfa'  => Yii::app()->createAbsoluteUrl('/v1/customer'),
            'beta'  => Yii::app()->createAbsoluteUrl('/v1/vector'),
            'gamma' => "Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.",
        );
    }

}