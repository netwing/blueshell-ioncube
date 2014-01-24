<?php

class m200000_100000_0 extends CDbMigration
{
	public function safeUp()
	{

        $this->alterColumn("{{order_detail}}", 'discount', "DECIMAL(10,3) NOT NULL DEFAULT '0.00'");
        $this->alterColumn("{{invoice_row}}", 'discount', "DECIMAL(10,3) NOT NULL DEFAULT '0.00'");
        
		return true;
	}

	public function safeDown()
	{      
    	return true;
	}

}
