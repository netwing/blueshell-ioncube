<?php

class CustomerController extends SoapController
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
     * @param integer Customer id
     * @return Customer customer object
     * @soap
     */
    public function get($id)
    {
        if (Yii::app()->user->checkAccess('admin:customer:read') === false) {
            $this->accessDenied();
        }
        $result = Customer::model()->findByPk((int) $id);
        if (!$result) {
            throw new SoapFault('NOT FOUND', 'Customer not found');
        }

        return $result;
    }

    /**
     * @return integer total customer
     * @soap
     */
    public function count()
    {
        if (Yii::app()->user->checkAccess('admin:customer:read') === false) {
            $this->accessDenied();
        }
        $result = Customer::model()->count();
        return $result;
    }

    /**
     * @param integer Limit
     * @param integer Offset
     * @return Customer[] a list of customer object
     * @soap
     */
    public function getList($limit, $offset)
    {
        if (Yii::app()->user->checkAccess('admin:customer:read') === false) {
            $this->accessDenied();
        }
        $criteria = new CDbCriteria();
        $criteria->limit = $limit;
        $criteria->offset = $offset;
        $total = Customer::model()->count();
        $result = Customer::model()->findAll($criteria);
        if (!$result) {
            throw new SoapFault('NOT FOUND', 'Customer not found');
        }

        return $result;
    }

    /**
     * @param array Customer attributes
     * @return Customer customer object
     * @soap
     */
    public function create($attributes)
    {        
        if (Yii::app()->user->checkAccess('admin:customer:create') === false) {
            $this->accessDenied();
        }
        $customer = new Customer();
        $customer->attributes = $attributes;
        if ($customer->validate() === false) {
            $errors = $customer->getErrors();
            $error = print_r(implode("; ", array_shift($errors)), true);
            throw new SoapFault("Application error", $error);
        }
        $customer->save();
        $result = $this->get($customer->cliente_id);
        return $result;
    }

    /**
     * @param integer Customer ID
     * @return Vector[] a list of customer vector
     * @soap
     */
    public function getVectors($id)
    {
        return Customer::model()->findByPk($id)->vectors;
    }
}