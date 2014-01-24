<?php

Yii::import("application.modules.admin.models.*");

/**
 * Class for bridging between old and new application
 */
class Bridge extends CApplicationComponent 
{

    public function orderFromContract($id)
    {
        $result = array();

        $id = intval($id);

        $criteria = new CDbCriteria;
        $criteria->condition = 'opened=:opened';
        $criteria->order = "sort_order ASC";
        $criteria->params = array(':opened' => 1);
        $status = OrderStatus::model()->find($criteria);

        $contract = Contract::model()->findByPk($id);

        // If reservations, do not create order
        if ($contract->type->reservation == 1) {
            return $result;
        }

        // Check if row already exists
        $order_detail = OrderDetail::model()->findByAttributes(array('contract_id' => $id));
        
        if ($order_detail) {

            // Update with contract data
            $order_detail->price = $contract->contratto_imponibile;
            $order_detail->quantity = 1;
            $order_detail->total_no_vat = $contract->contratto_imponibile;
            $order_detail->vat = VAT_PERCENTAGE;
            $order_detail->vat_value = ($contract->contratto_totale - $contract->contratto_imponibile);
            $order_detail->discount = $contract->contratto_sconto;
            $discount_value = $contract->contratto_totale / 100 * $contract->contratto_sconto;
            $order_detail->discount_value = $discount_value;
            $order_detail->total_vat = ($contract->contratto_totale - $contract->contratto_imponibile);
            $order_detail->total = $contract->contratto_totale - $discount_value;
            // Save
            $order_detail->save();
            // Return error if any
            $result+= $order_detail->getErrors();

        } else {

            // Create a new order for this customer, of type "2"
            $order = new Order();
            $order->customer_id = $contract->contratto_anagrafica2;
            if ($contract->contratto_tipo == "3") {
                $order->customer_id = $contract->contratto_anagrafica1;
            }
            if ($contract->contratto_barca) {
                $order->vector_id = $contract->contratto_barca;
            }
            $order->date = $contract->contratto_data;
            $order->type_id = 2;
            $order->status_id = $status->id;
            $result+= $order->getErrors();

            if ($order->save()) {
                // Create a new row with contract_id
                $order_detail = new OrderDetail();
                $order_detail->order_id = (integer) $order->id;
                $order_detail->contract_id = intval($_GET['id']);
                $order_detail->price = (float) $contract->contratto_imponibile;
                $order_detail->quantity = 1;
                $order_detail->total_no_vat = (float) $contract->contratto_imponibile;
                $order_detail->vat = VAT_PERCENTAGE;
                $order_detail->vat_value = ((float) $contract->contratto_totale - (float) $contract->contratto_imponibile);
                $order_detail->discount = (float) $contract->contratto_sconto;
                $discount_value = $contract->contratto_totale / 100 * $contract->contratto_sconto;
                $order_detail->discount_value = $discount_value;
                $order_detail->total_vat = ($contract->contratto_totale - $contract->contratto_imponibile);
                $order_detail->total = $contract->contratto_totale - $discount_value;
                $order_detail->done = 1;

                $order_detail->save();

                $result+= $order_detail->getErrors();
            }


        }

        return $result;
    }

    /**
     * Render URL correct if in Yii app or in old app
     */
    public function menuUrl($route, $params = array())
    {
        $url = Yii::app()->createUrl($route, $params);
        list($base, $query) = explode("?", $url);
        $result = APPLICATION_BASE_URL . "/app/index.php?" . $query;
        if (substr(Yii::app()->request->requestUri, 0, 4) == '/app') {
            $result = Yii::app()->createUrl($route, $params);
        }

        return $result;
    }
 
    /**
     * Render URL correct if in Yii app or in old app
     */
    public function oldUrl($route, $params = array())
    {
        $result = $route;
        if (stripos(Yii::app()->request->requestUri, APPLICATION_BASE_URL . "/app/") !== false) {
            $result = "../" . $route;
        }

        return $result;
    }
}