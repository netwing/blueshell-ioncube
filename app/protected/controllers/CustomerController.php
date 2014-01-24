<?php

class CustomerController extends Controller
{

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
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
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function restEvents()
    {

        $this->onRest('post.filter.req.auth.user', function($validation) {
            if(!$validation) {
                return false;
            }
            switch ($this->getAction()->getId()) {
                case 'REST.GET':
                    return Yii::app()->user->checkAccess('admin:customer:read');
                    break;
                case 'REST.PUT':
                    return Yii::app()->user->checkAccess('admin:customer:create');
                    break;
                case 'REST.POST':
                    return Yii::app()->user->checkAccess('admin:customer:update');
                    break;
                case 'REST.DELETE':
                    return Yii::app()->user->checkAccess('admin:customer:delete');
                    break;
                default:
                    return false;
                    break;
            }
        });

        $this->onRest('model.visible.properties', function() {
            return ['cliente_id', 'cliente_nominativo'];
        });

        $this->onRest('model.with.relations', function($model) {
            $nestedRelations = ['orders'];
            return $nestedRelations;
        });

    }

}