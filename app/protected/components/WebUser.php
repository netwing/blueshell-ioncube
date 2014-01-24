<?php

class WebUser extends CWebUser
{
    public function isAdmin()
    {
        return ($this->getState('role') == 'admin');
    }

    public function logout($destroySession = true)
    {
        $auth = Yii::app()->authManager;
        $assigned_roles = $auth->getRoles(Yii::app()->user->id); //obtains all assigned roles for this user id
        if(!empty($assigned_roles)) { //checks that there are assigned roles
            foreach(array_keys($assigned_roles) as $n) {
                $auth->revoke($n, Yii::app()->user->id);
            }
            $auth->save(); //again always save the result
        }
        // If root login
        if (Yii::app()->user->id == 0) {
            $roles = $auth->getRoles(Yii::app()->user->id);
            foreach(array_keys($roles) as $n) {
                $auth->revoke($n, Yii::app()->user->id);            
            }
            $tasks = $auth->getTasks(Yii::app()->user->id);
            foreach(array_keys($tasks) as $n) {
                $auth->revoke($n, Yii::app()->user->id);            
            }
            $operations = $auth->getOperations(Yii::app()->user->id);
            foreach(array_keys($operations) as $n) {
                $auth->revoke($n, Yii::app()->user->id);            
            }
            $auth->save(); //again always save the result
        }
        parent::logout();
    }
}
