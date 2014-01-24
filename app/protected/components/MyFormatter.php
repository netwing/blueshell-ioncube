<?php

class MyFormatter extends CLocalizedFormatter 
{

    // Localize to Yes everything evaluable as true; No for everything else
    public function formatBooleanString($value)
    {
        if ($value) return Yii::t('app','Yes');
        return Yii::t('app','No');
    }

    // Return green tick icon for true and red cross for false
    public function formatBooleanIcon($value)
    {
        if ($value) {
            $result = '<span class="text-success"><i class="fa fa-check"></i></span>';
        } else {
            $result = '<span class="text-danger"><i class="fa fa-times"></i></span>';
        }
        return $result;
    }

    // Localize INCOME and OUTCOME
    public function formatInvoiceType($value)
    {
        return ($value == 'INCOME') ? Yii::t('app','Income') : Yii::t('app','Outcome');
    }

    /**
     * Customer Link to detail
     * @return string html ready to use
     */
    public function formatCustomerDetailLink(Customer $customer)
    {
        return '<a href="' . Yii::app()->createUrl("/admin/customer/detail", array("id" => $customer->cliente_id)) 
                            . '">' . $customer->cliente_nominativo . '</a>';
    }

    /**
     * Customer Link to detail #order
     * @return string html ready to use
     */
    public function formatCustomerDetailOrderLink(Customer $customer)
    {
        return '<a href="' . Yii::app()->createUrl("/admin/customer/detail", array("id" => $customer->cliente_id, "#" => "order")) 
                            . '">' . $customer->cliente_nominativo . '</a>';
    }

    /**
     * Customer Link to detail #invoice
     * @return string html ready to use
     */
    public function formatCustomerDetailInvoiceLink(Customer $customer)
    {
        return '<a href="' . Yii::app()->createUrl("/admin/customer/detail", array("id" => $customer->cliente_id, "#" => "invoice")) 
                            . '">' . $customer->cliente_nominativo . '</a>';
    }

    // Return background-color and color for text
    public function formatTextColor($value)
    {
        if (!is_object($value) and !is_array($value)) {
            throw new Exception("Value for formatTextColor should be an object or an array.");
        }
        if (!isset($value['name'])) {
            throw new Exception("Object or array passed as argument must contain a 'name' attribute.");   
        }
        if (!isset($value['color'])) {
            throw new Exception("Object or array passed as argument must contain a 'color' attribute.");   
        }

        if ($value->color == "") {
            $value->color = "#ffffff";
        }

        $result = '<span style="white-space: nowrap; font-weight: bold; padding: 3px; color:' . Color::getContrastYIQ($value->color) . '; background-color:' . $value->color . ';">'
                . $value->name
                . '</span>';

        return $result;
    }

    public function formatCurrency($value)
    {
        defined("APPLICATION_CURRENCY") or define("APPLICATION_CURRENCY", "EUR");
        return Yii::app()->numberFormatter->formatCurrency($value, APPLICATION_CURRENCY);
    }

    public function formatDecimal($value) 
    {
        return Yii::app()->numberFormatter->format('0.00', $value);
    }

    public function formatDate($value) 
    {
        $this->dateFormat = "medium";
        if ($value === null or $value == "" or $value == "0000-00-00") {
            return null;
        }
        return parent::formatDate($value);
    }

    public function formatDateShort($value) 
    {
        $this->dateFormat = "short";
        if ($value === null or $value == "" or $value == "0000-00-00") {
            return null;
        }
        return parent::formatDate($value);
    }

    public function formatDateLong($value) 
    {
        $this->dateFormat = "long";
        if ($value === null or $value == "" or $value == "0000-00-00") {
            return null;
        }
        return parent::formatDate($value);
    }

    public function formatDateFull($value) 
    {
        $this->dateFormat = "full";
        if ($value === null or $value == "" or $value == "0000-00-00") {
            return null;
        }
        return parent::formatDate($value);
    }

    public function formatTime($value) 
    {
        $this->timeFormat = "medium";
        if ($value === null or $value == "") {
            return null;
        }
        return parent::formatTime($value);
    }

    public function formatTimeShort($value) 
    {
        $this->timeFormat = "short";
        if ($value === null or $value == "") {
            return null;
        }
        return parent::formatTime($value);
    }

    public function formatTimeLong($value) 
    {
        $this->timeFormat = "long";
        if ($value === null or $value == "") {
            return null;
        }
        return parent::formatTime($value);
    }

    public function formatTimeFull($value) 
    {
        $this->timeFormat = "full";
        if ($value === null or $value == "") {
            return null;
        }
        return parent::formatTime($value);
    }

    public function formatDatetime($value) 
    {
        $this->dateFormat = "medium";
        return parent::formatDatetime($value);
    }

    public function formatDatetimeShort($value) 
    {
        $this->dateFormat = "short";
        return parent::formatDatetime($value);
    }

    public function formatDatetimeLong($value) 
    {
        $this->dateFormat = "long";
        return parent::formatDatetime($value);
    }

    public function formatDatetimeFull($value) 
    {
        $this->dateFormat = "full";
        return parent::formatDatetime($value);
    }

}
