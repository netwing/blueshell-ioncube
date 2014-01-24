<?php

class VectorController extends CController
{

    /**
     * Define action handled by CWebServiceAction
     */
    public function filters()
    {
        return array(
            // 'accessControl', // perform access control for CRUD operations
            array(
                'RestfullYii.filters.ERestFilter + 
                REST.GET, REST.PUT, REST.POST, REST.DELETE'
            ),
        );
    } 

    public function actions()
    {
        return array(
            'REST.'=>'RestfullYii.actions.ERestActionProvider',
        );
    }  

    public function accessRules()
    {
        return array(
            array('allow', 'actions'=>array('REST.GET', 'REST.PUT', 'REST.POST', 'REST.DELETE'),
            'users'=>array('*'),
            ),
            /*
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
            */
        );
    }

    /** 
     * @return boolean
     * @soap
     */
    public function index()
    {   
        return true;
    }

}