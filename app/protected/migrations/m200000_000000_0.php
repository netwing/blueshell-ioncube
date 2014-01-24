<?php

class m200000_000000_0 extends CDbMigration
{
	public function safeUp()
	{

        $auth = Yii::app()->authManager;

        $task = $auth->createTask("admin:main", Yii::t('app', 'Main access'));
        $auth->createOperation("admin:main:read", Yii::t('app', 'Allow'));

        $task->addChild("admin:main:read");

        $task = $auth->createTask("admin:contract", Yii::t('app', 'Contracts'));
        $auth->createOperation("admin:contract:create", Yii::t('app', 'Create'));
        $auth->createOperation("admin:contract:read", Yii::t('app', 'Read'));
        $auth->createOperation("admin:contract:update", Yii::t('app', 'Update'));
        $auth->createOperation("admin:contract:delete", Yii::t('app', 'Delete'));

        $task->addChild("admin:contract:create");
        $task->addChild("admin:contract:read");
        $task->addChild("admin:contract:update");
        $task->addChild("admin:contract:delete");

        $task = $auth->createTask("admin:customer", Yii::t('app', 'Customers'));
        $auth->createOperation("admin:customer:create", Yii::t('app', 'Create'));
        $auth->createOperation("admin:customer:read", Yii::t('app', 'Read'));
        $auth->createOperation("admin:customer:update", Yii::t('app', 'Update'));
        $auth->createOperation("admin:customer:delete", Yii::t('app', 'Delete'));

        $task->addChild("admin:customer:create");
        $task->addChild("admin:customer:read");
        $task->addChild("admin:customer:update");
        $task->addChild("admin:customer:delete");

        $task = $auth->createTask("admin:vector", Yii::t('app', 'Vectors'));
        $auth->createOperation("admin:vector:create", Yii::t('app', 'Create'));
        $auth->createOperation("admin:vector:read", Yii::t('app', 'Read'));
        $auth->createOperation("admin:vector:update", Yii::t('app', 'Update'));
        $auth->createOperation("admin:vector:delete", Yii::t('app', 'Delete'));

        $task->addChild("admin:vector:create");
        $task->addChild("admin:vector:read");
        $task->addChild("admin:vector:update");
        $task->addChild("admin:vector:delete");

        $task = $auth->createTask("admin:resource", Yii::t('app', 'Resources'));
        $auth->createOperation("admin:resource:create", Yii::t('app', 'Create'));
        $auth->createOperation("admin:resource:read", Yii::t('app', 'Read'));
        $auth->createOperation("admin:resource:update", Yii::t('app', 'Update'));
        $auth->createOperation("admin:resource:delete", Yii::t('app', 'Delete'));

        $task->addChild("admin:resource:create");
        $task->addChild("admin:resource:read");
        $task->addChild("admin:resource:update");
        $task->addChild("admin:resource:delete");

        $task = $auth->createTask("admin:document", Yii::t('app', 'Documents'));
        $auth->createOperation("admin:document:create", Yii::t('app', 'Create'));
        $auth->createOperation("admin:document:read", Yii::t('app', 'Read'));
        $auth->createOperation("admin:document:update", Yii::t('app', 'Update'));
        $auth->createOperation("admin:document:delete", Yii::t('app', 'Delete'));

        $task->addChild("admin:document:create");
        $task->addChild("admin:document:read");
        $task->addChild("admin:document:update");
        $task->addChild("admin:document:delete");

        $task = $auth->createTask("admin:invoice", Yii::t('app', 'Invoices'));
        $auth->createOperation("admin:invoice:create", Yii::t('app', 'Create'));
        $auth->createOperation("admin:invoice:read", Yii::t('app', 'Read'));
        $auth->createOperation("admin:invoice:update", Yii::t('app', 'Update'));
        $auth->createOperation("admin:invoice:delete", Yii::t('app', 'Delete'));

        $task->addChild("admin:invoice:create");
        $task->addChild("admin:invoice:read");
        $task->addChild("admin:invoice:update");
        $task->addChild("admin:invoice:delete");

        $task = $auth->createTask("admin:template", Yii::t('app', 'Print templates'));
        $auth->createOperation("admin:template:create", Yii::t('app', 'Create'));
        $auth->createOperation("admin:template:read", Yii::t('app', 'Read'));
        $auth->createOperation("admin:template:update", Yii::t('app', 'Update'));
        $auth->createOperation("admin:template:delete", Yii::t('app', 'Delete'));

        $task->addChild("admin:template:create");
        $task->addChild("admin:template:read");
        $task->addChild("admin:template:update");
        $task->addChild("admin:template:delete");

        $task = $auth->createTask("admin:pricelist", Yii::t('app', 'Prices lists'));
        $auth->createOperation("admin:pricelist:create", Yii::t('app', 'Create'));
        $auth->createOperation("admin:pricelist:read", Yii::t('app', 'Read'));
        $auth->createOperation("admin:pricelist:update", Yii::t('app', 'Update'));
        $auth->createOperation("admin:pricelist:delete", Yii::t('app', 'Delete'));

        $task->addChild("admin:pricelist:create");
        $task->addChild("admin:pricelist:read");
        $task->addChild("admin:pricelist:update");
        $task->addChild("admin:pricelist:delete");

        $task = $auth->createTask("admin:preference", Yii::t('app', 'Preferences'));
        $auth->createOperation("admin:preference:create", Yii::t('app', 'Create'));
        $auth->createOperation("admin:preference:read", Yii::t('app', 'Read'));
        $auth->createOperation("admin:preference:update", Yii::t('app', 'Update'));
        $auth->createOperation("admin:preference:delete", Yii::t('app', 'Delete'));

        $task->addChild("admin:preference:create");
        $task->addChild("admin:preference:read");
        $task->addChild("admin:preference:update");
        $task->addChild("admin:preference:delete");

        // Allow this operations to role
        $role_admin = $auth->getAuthItem('ADMIN');
        $role_admin->addChild("admin:main:read");

        $role_admin->addChild("admin:contract:create");
        $role_admin->addChild("admin:contract:update");
        $role_admin->addChild("admin:contract:read");
        $role_admin->addChild("admin:contract:delete");

        $role_admin->addChild("admin:customer:create");
        $role_admin->addChild("admin:customer:update");
        $role_admin->addChild("admin:customer:read");
        $role_admin->addChild("admin:customer:delete");

        $role_admin->addChild("admin:vector:create");
        $role_admin->addChild("admin:vector:update");
        $role_admin->addChild("admin:vector:read");
        $role_admin->addChild("admin:vector:delete");

        $role_admin->addChild("admin:resource:create");
        $role_admin->addChild("admin:resource:update");
        $role_admin->addChild("admin:resource:read");
        $role_admin->addChild("admin:resource:delete");

        $role_admin->addChild("admin:document:create");
        $role_admin->addChild("admin:document:update");
        $role_admin->addChild("admin:document:read");
        $role_admin->addChild("admin:document:delete");

        $role_admin->addChild("admin:invoice:create");
        $role_admin->addChild("admin:invoice:update");
        $role_admin->addChild("admin:invoice:read");
        $role_admin->addChild("admin:invoice:delete");

        $role_admin->addChild("admin:template:create");
        $role_admin->addChild("admin:template:update");
        $role_admin->addChild("admin:template:read");
        $role_admin->addChild("admin:template:delete");

        $role_admin->addChild("admin:pricelist:create");
        $role_admin->addChild("admin:pricelist:update");
        $role_admin->addChild("admin:pricelist:read");
        $role_admin->addChild("admin:pricelist:delete");

        $role_admin->addChild("admin:preference:create");
        $role_admin->addChild("admin:preference:update");
        $role_admin->addChild("admin:preference:read");
        $role_admin->addChild("admin:preference:delete");

        $auth->save();

        // Copy all user from old tables to new table
        $role = '["USER"]';
        $this->truncateTable("{{user}}");
        $this->execute("INSERT INTO {{user}} (name, username, password, role) SELECT utente_nominativo, utente_username, utente_password, '" . $role . "' FROM {{utenti}}");

        // Product groups
        $this->createTable('{{product_group}}', array(
            "id"            => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ",
            "name"          => "VARCHAR(255) NOT NULL",
            "description"   => "TEXT NULL",
            "enabled"       => "TINYINT(1) UNSIGNED DEFAULT '1'",
            "sort_order"    => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
            "create_time"   => "DATETIME",
            "update_time"   => "DATETIME",
        ), 'ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci');

        $this->insert("{{product_group}}", array('name' => 'Attrezzature', 'create_time' => new CDbExpression('NOW()')));
        $this->insert("{{product_group}}", array('name' => 'Prodotti consumabili', 'create_time' => new CDbExpression('NOW()')));
        $this->insert("{{product_group}}", array('name' => 'Manodopera', 'create_time' => new CDbExpression('NOW()')));
        $this->insert("{{product_group}}", array('name' => 'Servizi', 'create_time' => new CDbExpression('NOW()')));

        // Products, services and so on
        $this->createTable('{{product}}', array(
            "id"            => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ",
            "group_id"      => "INT(11) UNSIGNED NOT NULL",
            "sku"           => "VARCHAR(255) NOT NULL",
            "name"          => "VARCHAR(255) NOT NULL",
            "description"   => "TEXT NULL",
            "measure_unit"  => "VARCHAR(255) NOT NULL",
            "price"         => "DECIMAL(10,2) NOT NULL DEFAULT '0.00'",
            "vat"           => "DECIMAL(10,2) NOT NULL DEFAULT '0.00'",
            "work_time"     => "DECIMAL(10,2) NOT NULL DEFAULT '0.00'",
            "enabled"       => "TINYINT(1) UNSIGNED DEFAULT '1'",
            "sort_order"    => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
            "create_time"   => "DATETIME",
            "update_time"   => "DATETIME",
        ), 'ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci');

        $this->addForeignKey('fk_product_group_id_' . DB_TABLE_PREFIX . 'product_group_id', '{{product}}', 'group_id', "{{product_group}}", "id", 'CASCADE', 'CASCADE');

        $this->insert("{{product}}", array('group_id' => 1, 
            'name' => 'Corda 5 millimetri', 
            'sku' => '1001005', 
            'measure_unit' => 'Metri', 
            'price' => '0.75', 
            'vat' => '22',
            'create_time' => new CDbExpression('NOW()')));
        $this->insert("{{product}}", array('group_id' => 1, 
            'name' => 'Paranco', 
            'sku' => '1002158', 
            'measure_unit' => 'Pezzi', 
            'price' => '125.00', 
            'vat' => '22',
            'create_time' => new CDbExpression('NOW()')));
        
        $this->insert("{{product}}", array('group_id' => 2, 
            'name' => 'Olio per motore', 
            'sku' => '1002874', 
            'measure_unit' => 'Litri', 
            'price' => '23.50', 
            'vat' => '22',
            'create_time' => new CDbExpression('NOW()')));
        $this->insert("{{product}}", array('group_id' => 2, 
            'name' => 'Vernice bianca', 
            'sku' => '1002548', 
            'measure_unit' => 'Litri', 
            'price' => '8.50', 
            'vat' => '22',
            'create_time' => new CDbExpression('NOW()')));
        
        $this->insert("{{product}}", array('group_id' => 3, 
            'name' => 'Carteggio', 
            'sku' => '3003558', 
            'measure_unit' => 'Ore', 
            'price' => '35.00', 
            'vat' => '22',
            'work_time' => '60',
            'create_time' => new CDbExpression('NOW()')));
        $this->insert("{{product}}", array('group_id' => 3, 
            'name' => 'Verniciatura', 
            'sku' => '3003252', 
            'measure_unit' => 'Ore', 
            'price' => '28.50', 
            'vat' => '22',
            'work_time' => '75',
            'create_time' => new CDbExpression('NOW()')));
        
        $this->insert("{{product}}", array('group_id' => 4, 
            'name' => 'Alaggio barca da 4 metri', 
            'sku' => '4404001', 
            'measure_unit' => 'Numero', 
            'price' => '250.00', 
            'vat' => '22',
            'work_time' => '120',
            'create_time' => new CDbExpression('NOW()')));
        $this->insert("{{product}}", array('group_id' => 4, 
            'name' => 'Varo barca da 4 metri', 
            'sku' => '4404002', 
            'measure_unit' => 'Numero', 
            'price' => '250.00', 
            'vat' => '22',
            'work_time' => '120',
            'create_time' => new CDbExpression('NOW()')));

        $this->insert("{{product}}", array('group_id' => 4, 
            'name' => 'Alaggio barca da 6 metri', 
            'sku' => '4406001', 
            'measure_unit' => 'Numero', 
            'price' => '375.00', 
            'vat' => '22',
            'work_time' => '180',
            'create_time' => new CDbExpression('NOW()')));
        $this->insert("{{product}}", array('group_id' => 4, 
            'name' => 'Varo barca da 6 metri', 
            'sku' => '4406002', 
            'measure_unit' => 'Numero', 
            'price' => '375.00', 
            'vat' => '22',
            'work_time' => '180',
            'create_time' => new CDbExpression('NOW()')));

        // Order status (active, pending, closed, etc...)
        $this->createTable('{{order_status}}', array(
            "id"            => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ",
            "name"          => "VARCHAR(255) NOT NULL DEFAULT ''",
            "color"         => "VARCHAR(255) NOT NULL DEFAULT ''",
            "quote"         => "TINYINT(1) UNSIGNED DEFAULT '0'",
            "opened"        => "TINYINT(1) UNSIGNED DEFAULT '0'",
            "pending"       => "TINYINT(1) UNSIGNED DEFAULT '0'",
            "closed"        => "TINYINT(1) UNSIGNED DEFAULT '0'",
            "cancelled"     => "TINYINT(1) UNSIGNED DEFAULT '0'",
            "sort_order"    => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
            "create_time"   => "DATETIME",
            "update_time"   => "DATETIME",
        ), 'ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci');

        $this->insert("{{order_status}}", array('name' => 'Quote', 'color' => "#eb84dd", 'quote' => 1, 'sort_order' => 1, 'create_time' => new CDbExpression('NOW()')));
        $this->insert("{{order_status}}", array('name' => 'Active', 'color' => "#00ff00", 'opened' => 1, 'sort_order' => 2, 'create_time' => new CDbExpression('NOW()')));
        $this->insert("{{order_status}}", array('name' => 'Pending', 'color' => "#f5911e", 'pending' => 1, 'sort_order' => 3, 'create_time' => new CDbExpression('NOW()')));
        $this->insert("{{order_status}}", array('name' => 'Closed', 'color' => "#bd0000", 'closed' => 1, 'sort_order' => 4, 'create_time' => new CDbExpression('NOW()')));
        $this->insert("{{order_status}}", array('name' => 'Cancelled', 'color' => "#adadad", 'cancelled' => 1, 'sort_order' => 5, 'create_time' => new CDbExpression('NOW()')));

        // Order type (standard order, contract order, service or consumption order)
        $this->createTable('{{order_type}}', array(
            "id"            => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ",
            "name"          => "VARCHAR(255) NOT NULL DEFAULT ''",
            "description"   => "TEXT",
            "color"         => "VARCHAR(255) NOT NULL DEFAULT ''",
            "show"          => "TINYINT(1) UNSIGNED DEFAULT '0'",
            "sort_order"    => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
            "create_time"   => "DATETIME",
            "update_time"   => "DATETIME",
        ), 'ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci');

        $this->insert("{{order_type}}", array(
            'name' => 'Order', 
            'description' => 'Standard order',
            'color' => "#66ccff", 
            'show' => 1, 'sort_order' => 1, 'create_time' => new CDbExpression('NOW()')
        ));
        $this->insert("{{order_type}}", array(
            'name' => 'Contract', 
            'description' => 'Contract order',
            'color' => "#ffcc66", 
            'show' => 0, 'sort_order' => 2, 'create_time' => new CDbExpression('NOW()')
        ));
        $this->insert("{{order_type}}", array(
            'name' => 'Service', 
            'description' => 'Service or usage order',
            'color' => "#66ffcc", 
            'show' => 1, 'sort_order' => 3, 'create_time' => new CDbExpression('NOW()')
        ));

        // Orders
        $this->createTable('{{order}}', array(
            "id"            => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ",
            "customer_id"   => "INT(10) UNSIGNED NOT NULL ",
            "vector_id"     => "INT(10) UNSIGNED NULL DEFAULT NULL",
            "date"          => "DATE NOT NULL",
            "work_date"     => "DATE NULL DEFAULT NULL",
            "due_date"      => "DATE NULL DEFAULT NULL",
            "work_number"   => "INT(11) UNSIGNED DEFAULT NULL",
            "type_id"       => "INT(11) UNSIGNED NOT NULL DEFAULT '1'",
            "status_id"     => "INT(11) UNSIGNED NOT NULL",
            "notes"         => "TEXT NULL",
            "create_time"   => "DATETIME",
            "update_time"   => "DATETIME",
        ), 'ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci');

        $this->addForeignKey('fk_order_customer_id_' . DB_TABLE_PREFIX . 'clienti_cliente_id', '{{order}}', 'customer_id', "{{clienti}}", "cliente_id", 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_order_vector_id_' . DB_TABLE_PREFIX . 'barche_barca_id', '{{order}}', 'vector_id', "{{barche}}", "barca_id", 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_order_status_id_' . DB_TABLE_PREFIX . 'order_status_id', '{{order}}', 'status_id', "{{order_status}}", "id", 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('fk_order_type_id_' . DB_TABLE_PREFIX . 'order_type_id', '{{order}}', 'type_id', "{{order_type}}", "id", 'RESTRICT', 'RESTRICT');

        // Orders details
        $this->createTable('{{order_detail}}', array(
            "id"                => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ",
            "order_id"          => "INT(11) UNSIGNED NOT NULL",
            "product_id"        => "INT(11) UNSIGNED NULL DEFAULT NULL",
            "contract_id"       => "INT(11) UNSIGNED NULL DEFAULT NULL",
            "price"             => "DECIMAL(10,2) NOT NULL DEFAULT '0.00'", // price singular object
            "quantity"          => "DECIMAL(10,2) NOT NULL DEFAULT '0.00'", // number of object
            "total_no_vat"      => "DECIMAL(10,2) NOT NULL DEFAULT '0.00'", // = price * number
            "vat"               => "DECIMAL(10,2) NOT NULL DEFAULT '0.00'", // percentage tax
            "vat_value"         => "DECIMAL(10,2) NOT NULL DEFAULT '0.00'", // value of vat
            "total_vat"         => "DECIMAL(10,2) NOT NULL DEFAULT '0.00'", // = (price * number) + VAT
            "discount"          => "DECIMAL(10,2) NOT NULL DEFAULT '0.00'", // percentage discount
            "discount_value"    => "DECIMAL(10,2) NOT NULL DEFAULT '0.00'", // value of discount
            "total"             => "DECIMAL(10,2) NOT NULL DEFAULT '0.00'", // total_vat - discount
            "work_time"         => "DECIMAL(10,2) NOT NULL DEFAULT '0.00'", // minutes of work for 1 quantity
            "total_work_time"   => "DECIMAL(10,2) NOT NULL DEFAULT '0.00'", // total minutes of work            
            "done"              => "TINYINT(1) UNSIGNED DEFAULT '0'", // mark as done by staff
            "notes"             => "TEXT DEFAULT NULL",
            "create_time"       => "DATETIME",
            "update_time"       => "DATETIME",
        ), 'ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci');

        $this->addForeignKey('fk_order_detail_order_id_' . DB_TABLE_PREFIX . 'order_id', '{{order_detail}}', 'order_id', "{{order}}", "id", 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_order_detail_product_id_' . DB_TABLE_PREFIX . 'product_id', '{{order_detail}}', 'product_id', "{{product}}", "id", 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('fk_order_detail_contract_id_' . DB_TABLE_PREFIX . 'contratti_id', '{{order_detail}}', 'contract_id', "{{contratti}}", "contratto_id", 'RESTRICT', 'RESTRICT');

        $auth = Yii::app()->authManager;

        // Create new task (operation collector)
        $task = $auth->createTask("admin:order", Yii::t('app', 'Ordini'));
        // Create new operation
        $auth->createOperation("admin:order:create", Yii::t('app', 'Create'));
        $auth->createOperation("admin:order:read", Yii::t('app', 'Read'));
        $auth->createOperation("admin:order:update", Yii::t('app', 'Update'));
        $auth->createOperation("admin:order:delete", Yii::t('app', 'Delete'));
        
        // Add operation to task
        $task->addChild("admin:order:create");
        $task->addChild("admin:order:read");
        $task->addChild("admin:order:update");
        $task->addChild("admin:order:delete");

        // Get admin role
        $role_admin = $auth->getAuthItem('ADMIN');

        // Add operation to admin role
        $role_admin->addChild("admin:order:create");
        $role_admin->addChild("admin:order:update");
        $role_admin->addChild("admin:order:read");
        $role_admin->addChild("admin:order:delete");

        $auth->save();

        // Product groups
        $this->createTable('{{system_template}}', array(
            "id"            => "VARCHAR(255) NOT NULL",
            "language"      => "VARCHAR(255) NOT NULL",
            "name"          => "VARCHAR(255) NOT NULL",
            "description"   => "TEXT NULL",
            "text_content"  => "TEXT",
            "html_content"  => "TEXT",
            "create_time"   => "DATETIME",
            "update_time"   => "DATETIME",
            "PRIMARY KEY (`id`, `language`)",
        ), 'ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci');

        $this->insert("{{system_template}}", array(
            'id'    => 'PRINT_HEADER',
            'name' => 'Header print', 
            "description" => "Header for all print",
            "text_content" => '{$smarty.const.APPLICATION_COMPANY_NAME}\n---------------------', 
            "html_content" => '<h2>{$smarty.const.APPLICATION_COMPANY_NAME}</h2> <hr />', 
            "language"  => "en",
            'create_time' => new CDbExpression('NOW()')
        ));

        $this->insert("{{system_template}}", array(
            'id'    => 'PRINT_FOOTER',
            'name' => 'Footer print', 
            "description" => "Footer for all print", 
            "text_content" => '---------------------', 
            "html_content" => '<table style="width: 100%;"><tr><td>{$footer_date}</td><td align="right">Page CURRENT_PAGE / TOTAL_PAGES</td></tr></table>', 
            "language"  => "en",
            'create_time' => new CDbExpression('NOW()')
        ));

        $this->insert("{{system_template}}", array(
            'id'    => 'PRINT_ORDER',
            'name' => 'Order print', 
            "description" => "Order print", 
            "text_content" => 'Hello, this is order is for {$order->customer->cliente_nominativo}', 
            "html_content" => '<h1>Order #{$order.id} {if $order.work_number} - Work number #{$order.work_number} {/if}</h1>
<h2>Client: {$order.customer.cliente_nominativo} {if $order.vector !== null} <br />Vector: {$order.vector.barca_nome} {$order.vector.barca_targa} {/if}</h2>
<p>Date: {$order_date}<br /> Work date: {$order_work_date}<br /> Due date: {$order_due_date}</p>
<table style="border: 1px solid black; width: 100%;" cellpadding="2">
<thead>
<tr><th>Product</th><th>Price</th><th>Quantity</th><th>Vat</th><th>Discount</th><th>Sub total</th></tr>
</thead>
<tbody><!-- {foreach $order.orderDetails as $k => $v} -->
<tr>
<td>{$v.product.name}</td>
<td style="text-align: right;">{$v.price}</td>
<td style="text-align: right;">{$v.quantity}</td>
<td style="text-align: right;">{$v.vat}</td>
<td style="text-align: right;">{$v.discount}</td>
<td style="text-align: right;">{$v.total}</td>
</tr>
<!-- {/foreach} --></tbody>
</table>
<table style="width: 100%;" cellpadding="4">
<thead>
<tr><th align="center">Net total</th><th align="center">VAT total</th><th align="center">Discount total</th><th align="center"><strong>Order total</strong></th></tr>
</thead>
<tbody>
<tr>
<td align="right">{$order.net_total}</td>
<td align="right">{$order.vat_total}</td>
<td align="right">{$order.discount_total}</td>
<td align="right"><strong>{$order.total}</strong></td>
</tr>
</tbody>
</table>
<h2>Notes:</h2>
<p>{$order.notes|nl2br}</p>', 
            "language"  => "en",
            'create_time' => new CDbExpression('NOW()')
        ));

        $this->insert("{{system_template}}", array(
            'id'    => 'PRINT_INVOICE',
            'name' => 'Invoice print', 
            "description" => "Invoice print", 
            "text_content" => 'Hello, this invoice is for {$invoice->customer->cliente_nominativo}', 
            "html_content" => '<h1>{$invoice.type.name}&nbsp;{if $invoice.invoice_number}{$invoice.type.prefix}{$invoice.invoice_number}{else}{$invoice.id}{/if}</h1>
<p>{$invoice.billing_header}<br /> {$invoice.billing_address}<br /> {$invoice.billing_zip}, {$invoice.billing_city}, {$invoice.billing_province}<br /> {$invoice.billing_country}<br /> {$invoice.billing_tax}</p>
<p>{if $invoice.status.unpaid}Date: {$invoice_date}<br />Due date: {$invoice_due_date} {elseif $invoice.status.paid}Date: {$invoice_date_paid} {else}Date: {$invoice_date}{/if}</p>
<table style="border: 1px solid black; width: 100%;" cellpadding="2" cellspacing="2">
<thead>
<tr><th>Description</th><th>Price</th><th>Quantity</th><th>Vat</th><th>Discount</th><th>Sub total</th></tr>
</thead>
<tbody><!-- {foreach $invoice.invoiceRows as $k => $v} --> <!-- {cycle values="#eeeeee,#d0d0d0" assign="trcolor"} -->
<tr style="background-color: {$trcolor};">
<td>{$v.description}</td>
<td style="text-align: right;">{$v.price}</td>
<td style="text-align: right;">{$v.quantity}</td>
<td style="text-align: right;">{$v.vat}</td>
<td style="text-align: right;">{$v.discount}</td>
<td style="text-align: right;">{$v.total}</td>
</tr>
<!-- {/foreach} --></tbody>
</table>
<table style="width: 100%;" cellpadding="4">
<thead>
<tr><th align="center">Net total</th><th align="center">VAT total</th><th align="center">Discount total</th><th align="center"><strong>Invoice&nbsp;total</strong></th></tr>
</thead>
<tbody>
<tr>
<td align="right">{$invoice.net_total}</td>
<td align="right">{$invoice.vat_total}</td>
<td align="right">{$invoice.discount_total}</td>
<td align="right"><strong>{$invoice.total}</strong></td>
</tr>
</tbody>
</table>
<h2>Notes:</h2>
<p>{$invoice.notes|nl2br}</p>', 
            "language"  => "en",
            'create_time' => new CDbExpression('NOW()')
        ));

        $auth = Yii::app()->authManager;

        $task = $auth->createTask("admin:systemTemplate", Yii::t('app', 'System templates'));
        $auth->createOperation("admin:systemTemplate:create", Yii::t('app', 'Create'));
        $auth->createOperation("admin:systemTemplate:read", Yii::t('app', 'Read'));
        $auth->createOperation("admin:systemTemplate:update", Yii::t('app', 'Update'));
        $auth->createOperation("admin:systemTemplate:delete", Yii::t('app', 'Delete'));

        $task->addChild("admin:systemTemplate:create");
        $task->addChild("admin:systemTemplate:read");
        $task->addChild("admin:systemTemplate:update");
        $task->addChild("admin:systemTemplate:delete");

        $role_admin = $auth->getAuthItem('ADMIN');

        $role_admin->addChild("admin:systemTemplate:create");
        $role_admin->addChild("admin:systemTemplate:update");
        $role_admin->addChild("admin:systemTemplate:read");
        $role_admin->addChild("admin:systemTemplate:delete");

        $auth->save();

        // Invoice status (paid, unpaid, cancelled)
        $this->createTable('{{invoice_status}}', array(
            "id"            => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ",
            "name"          => "VARCHAR(255) NOT NULL DEFAULT ''",
            "color"         => "VARCHAR(255) NOT NULL DEFAULT ''",
            "paid"          => "TINYINT(1) UNSIGNED DEFAULT '0'",
            "unpaid"        => "TINYINT(1) UNSIGNED DEFAULT '0'",
            "cancelled"     => "TINYINT(1) UNSIGNED DEFAULT '0'",
            "sort_order"    => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
            "create_time"   => "DATETIME",
            "update_time"   => "DATETIME",
        ), 'ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci');

        $this->insert("{{invoice_status}}", array('name' => 'Paid', 'color' => "#00ff00", 'paid' => 1, 'sort_order' => 1, 'create_time' => new CDbExpression('NOW()')));
        $this->insert("{{invoice_status}}", array('name' => 'Unpaid', 'color' => "#f5911e", 'unpaid' => 1, 'sort_order' => 2, 'create_time' => new CDbExpression('NOW()')));
        $this->insert("{{invoice_status}}", array('name' => 'Cancelled', 'color' => "#ababab", 'cancelled' => 1, 'sort_order' => 3, 'create_time' => new CDbExpression('NOW()')));

        // Invoice type (invoice, credit note and different invoice lines)
        $this->createTable('{{invoice_type}}', array(
            "id"            => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ",
            "name"          => "VARCHAR(255) NOT NULL DEFAULT ''",
            "description"   => "TEXT",
            "color"         => "VARCHAR(255) NOT NULL DEFAULT ''",
            "type"          => "ENUM('INCOME', 'OUTCOME')",
            "prefix"        => "VARCHAR(255) NOT NULL DEFAULT ''",
            "year_restart"  => "TINYINT(1) UNSIGNED NOT NULL DEFAULT '1'",
            "sort_order"    => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
            "enabled"       => "TINYINT(1) UNSIGNED DEFAULT '1'",
            "create_time"   => "DATETIME",
            "update_time"   => "DATETIME",
        ), 'ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci');

        $this->insert("{{invoice_type}}", array(
            'name' => 'Invoice', 
            'description' => 'Standard invoice',
            'color' => "#66ccff", 
            'type' => "INCOME", 'sort_order' => 1, 'create_time' => new CDbExpression('NOW()')
        ));
        $this->insert("{{invoice_type}}", array(
            'name' => 'Credit note', 
            'description' => 'Credit note',
            'color' => "#ffcc66", 
            'type' => "OUTCOME", 'sort_order' => 2, 'create_time' => new CDbExpression('NOW()')
        ));

        // Invoices
        $this->createTable('{{invoice}}', array(
            "id"                => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY",
            "customer_id"       => "INT(10) UNSIGNED NOT NULL",
            "invoice_number"    => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
            "date"              => "DATE NOT NULL",

            "billing_header"    => "TEXT NOT NULL",
            "billing_address"   => "TEXT NOT NULL",
            "billing_zip"       => "TEXT NULL DEFAULT NULL",
            "billing_city"      => "TEXT NULL DEFAULT NULL",
            "billing_province"  => "TEXT NULL DEFAULT NULL",
            "billing_country"   => "TEXT NULL DEFAULT NULL",
            "billing_tax"       => "TEXT NOT NULL",

            "shipping_header"    => "TEXT NULL DEFAULT NULL",
            "shipping_address"   => "TEXT NULL DEFAULT NULL",
            "shipping_zip"       => "TEXT NULL DEFAULT NULL",
            "shipping_city"      => "TEXT NULL DEFAULT NULL",
            "shipping_province"  => "TEXT NULL DEFAULT NULL",
            "shipping_country"   => "TEXT NULL DEFAULT NULL",

            "status_id"         => "INT(11) UNSIGNED NOT NULL",
            "type_id"           => "INT(11) UNSIGNED NOT NULL",
            "due_date"          => "DATE NULL DEFAULT NULL",
            "date_paid"         => "DATE NULL DEFAULT NULL",
            "payment_method"    => "TEXT",
            "notes"             => "TEXT NULL",
            "create_time"       => "DATETIME",
            "update_time"       => "DATETIME",
        ), 'ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci');

        $this->addForeignKey('fk_invoice_customer_id_' . DB_TABLE_PREFIX . 'clienti_cliente_id', '{{invoice}}', 'customer_id', "{{clienti}}", "cliente_id", 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_invoice_status_id_' . DB_TABLE_PREFIX . 'invoice_status_id', '{{invoice}}', 'status_id', "{{invoice_status}}", "id", 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('fk_invoice_type_id_' . DB_TABLE_PREFIX . 'invoice_type_id', '{{invoice}}', 'type_id', "{{invoice_type}}", "id", 'RESTRICT', 'RESTRICT');

        // Invoice rows
        $this->createTable('{{invoice_row}}', array(
            "id"                => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ",
            "invoice_id"        => "INT(11) UNSIGNED NOT NULL",
            "order_detail_id"   => "INT(11) UNSIGNED NULL DEFAULT NULL",
            "description"       => "TEXT NOT NULL",
            "price"             => "DECIMAL(10,2) NOT NULL DEFAULT '0.00'", // price singular object
            "quantity"          => "DECIMAL(10,2) NOT NULL DEFAULT '0.00'", // number of object
            "total_no_vat"      => "DECIMAL(10,2) NOT NULL DEFAULT '0.00'", // = price * number
            "vat"               => "DECIMAL(10,2) NOT NULL DEFAULT '0.00'", // percentage tax
            "vat_value"         => "DECIMAL(10,2) NOT NULL DEFAULT '0.00'", // value of vat
            "total_vat"         => "DECIMAL(10,2) NOT NULL DEFAULT '0.00'", // = (price * number) + VAT
            "discount"          => "DECIMAL(10,2) NOT NULL DEFAULT '0.00'", // percentage discount
            "discount_value"    => "DECIMAL(10,2) NOT NULL DEFAULT '0.00'", // value of discount
            "total"             => "DECIMAL(10,2) NOT NULL DEFAULT '0.00'", // total_vat - discount
            "notes"             => "TEXT DEFAULT NULL",
            "create_time"       => "DATETIME",
            "update_time"       => "DATETIME",
        ), 'ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci');

        $this->addForeignKey('fk_invoice_row_id_' . DB_TABLE_PREFIX . 'invoice_id', '{{invoice_row}}', 'invoice_id', "{{invoice}}", "id", 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_invoice_row_order_detail_id_' . DB_TABLE_PREFIX . 'order_detail_id', '{{invoice_row}}', 'order_detail_id', "{{order_detail}}", "id", 'RESTRICT', 'RESTRICT');

        $this->addColumn('{{contratti_tipo}}', 'color', "VARCHAR(255) NOT NULL DEFAULT ''");
        $this->addColumn('{{contratti_tipo}}', 'prefix', "VARCHAR(255) NOT NULL DEFAULT ''");
        $this->addColumn('{{contratti_tipo}}', 'rent', "TINYINT(1) UNSIGNED DEFAULT '0'");
        $this->addColumn('{{contratti_tipo}}', 'transit', "TINYINT(1) UNSIGNED DEFAULT '0'");
        $this->addColumn('{{contratti_tipo}}', 'sell', "TINYINT(1) UNSIGNED DEFAULT '0'");
        $this->addColumn('{{contratti_tipo}}', 'option', "TINYINT(1) UNSIGNED DEFAULT '0'");
        $this->addColumn('{{contratti_tipo}}', 'manage', "TINYINT(1) UNSIGNED DEFAULT '0'");
        $this->addColumn('{{contratti_tipo}}', 'reservation', "TINYINT(1) UNSIGNED DEFAULT '0'");
        $this->addColumn('{{contratti_tipo}}', 'sort_order', "INT(11) UNSIGNED NOT NULL DEFAULT '0'");
        $this->addColumn('{{contratti_tipo}}', 'enabled', "TINYINT(1) UNSIGNED DEFAULT '1'");
        $this->addColumn('{{contratti_tipo}}', 'create_time', "DATETIME");
        $this->addColumn('{{contratti_tipo}}', 'update_time', "DATETIME");

        $this->update('{{contratti_tipo}}', array(
            'color' => '#ffff00',
            'rent'  => 1,
            'sort_order' => 1,
            'create_time' => new CDbExpression('NOW()'),
            'update_time' => new CDbExpression('NOW()'),
        ), 'contratto_tipo_id = 1');

        $this->update('{{contratti_tipo}}', array(
            'color' => '#00ffff',
            'transit'  => 1,
            'sort_order' => 2,
            'create_time' => new CDbExpression('NOW()'),
            'update_time' => new CDbExpression('NOW()'),
        ), 'contratto_tipo_id = 11');

        $this->update('{{contratti_tipo}}', array(
            'color' => '#ff0000',
            'sell'  => 1,
            'sort_order' => 3,
            'create_time' => new CDbExpression('NOW()'),
            'update_time' => new CDbExpression('NOW()'),
        ), 'contratto_tipo_id = 2');

        $this->update('{{contratti_tipo}}', array(
            'color' => '#9999ff',
            'option'  => 1,
            'sort_order' => 4,
            'create_time' => new CDbExpression('NOW()'),
            'update_time' => new CDbExpression('NOW()'),
        ), 'contratto_tipo_id = 13');

        $this->update('{{contratti_tipo}}', array(
            'color' => '#ff00ff',
            'manage'  => 1,
            'sort_order' => 5,
            'create_time' => new CDbExpression('NOW()'),
            'update_time' => new CDbExpression('NOW()'),
        ), 'contratto_tipo_id = 3');

        $this->update('{{contratti_tipo}}', array(
            'color' => '#00ff00',
            'reservation'  => 1,
            'sort_order' => 6,
            'create_time' => new CDbExpression('NOW()'),
            'update_time' => new CDbExpression('NOW()'),
        ), 'contratto_tipo_id = 4');


        $this->addColumn('{{dimensioni}}', 'create_time', "TIMESTAMP");        
        $this->addColumn('{{dimensioni}}', 'update_time', "TIMESTAMP");        

        $this->addColumn('{{clienti}}', 'country', "VARCHAR(255) NOT NULL DEFAULT ''");
        $this->createIndex("idx_clienti_country", "{{clienti}}", "country", false);
        $this->addColumn('{{clienti}}', 'create_time', "TIMESTAMP");        
        $this->addColumn('{{clienti}}', 'update_time', "TIMESTAMP");        

        $this->addColumn('{{barche}}', 'builder', "VARCHAR(255) NOT NULL DEFAULT ''");
        $this->createIndex("idx_barche_builder", "{{barche}}", "builder", false);

        $this->addColumn('{{barche}}', 'insurance_company', "VARCHAR(255) NOT NULL DEFAULT ''");
        $this->createIndex("idx_barche_insurance_company", "{{barche}}", "insurance_company", false);

        $this->addColumn('{{barche}}', 'country', "VARCHAR(255) NOT NULL DEFAULT ''");
        $this->createIndex("idx_barche_country", "{{barche}}", "country", false);
        
        $this->addColumn('{{barche}}', 'create_time', "TIMESTAMP");        
        $this->addColumn('{{barche}}', 'update_time', "TIMESTAMP");   
        
		return true;
	}

	public function safeDown()
	{

		$auth = Yii::app()->authManager;
	
		$auth->removeAuthItem("admin:main");
		$auth->removeAuthItem("admin:contract");
		$auth->removeAuthItem("admin:customer");
		$auth->removeAuthItem("admin:vector");
		$auth->removeAuthItem("admin:resource");
		$auth->removeAuthItem("admin:document");
		$auth->removeAuthItem("admin:invoice");
		$auth->removeAuthItem("admin:template");
		$auth->removeAuthItem("admin:pricelist");
		$auth->removeAuthItem("admin:preference");

        $auth->removeAuthItem("admin:main:allow");
        $auth->removeAuthItem("admin:contract:create");
        $auth->removeAuthItem("admin:contract:read");
        $auth->removeAuthItem("admin:contract:update");
        $auth->removeAuthItem("admin:contract:delete");
        $auth->removeAuthItem("admin:customer:create");
        $auth->removeAuthItem("admin:customer:read");
        $auth->removeAuthItem("admin:customer:update");
        $auth->removeAuthItem("admin:customer:delete");
        $auth->removeAuthItem("admin:vector:create");
        $auth->removeAuthItem("admin:vector:read");
        $auth->removeAuthItem("admin:vector:update");
        $auth->removeAuthItem("admin:vector:delete");
        $auth->removeAuthItem("admin:resource:create");
        $auth->removeAuthItem("admin:resource:read");
        $auth->removeAuthItem("admin:resource:update");
        $auth->removeAuthItem("admin:resource:delete");
        $auth->removeAuthItem("admin:document:create");
        $auth->removeAuthItem("admin:document:read");
        $auth->removeAuthItem("admin:document:update");
        $auth->removeAuthItem("admin:document:delete");
        $auth->removeAuthItem("admin:invoice:create");
        $auth->removeAuthItem("admin:invoice:read");
        $auth->removeAuthItem("admin:invoice:update");
        $auth->removeAuthItem("admin:invoice:delete");
        $auth->removeAuthItem("admin:template:create");
        $auth->removeAuthItem("admin:template:read");
        $auth->removeAuthItem("admin:template:update");
        $auth->removeAuthItem("admin:template:delete");
        $auth->removeAuthItem("admin:pricelist:create");
        $auth->removeAuthItem("admin:pricelist:read");
        $auth->removeAuthItem("admin:pricelist:update");
        $auth->removeAuthItem("admin:pricelist:delete");
        $auth->removeAuthItem("admin:preference:create");
        $auth->removeAuthItem("admin:preference:read");
        $auth->removeAuthItem("admin:preference:update");
        $auth->removeAuthItem("admin:preference:delete");

        $this->truncateTable("{{user}}");

		$auth->save();

        $this->execute("SET foreign_key_checks = 0;");

        try {
            $table = "order_detail";
            $this->dropTable('{{' . $table . '}}');
        } catch (Exception $e) {
            echo "Table '" . $table ."' not found" . PHP_EOL;
        }

        try {
            $table = "order";
            $this->dropTable('{{' . $table . '}}');
        } catch (Exception $e) {
            echo "Table '" . $table ."' not found" . PHP_EOL;
        }

        try {
            $table = "order_status";
            $this->dropTable('{{' . $table . '}}');
        } catch (Exception $e) {
            echo "Table '" . $table ."' not found" . PHP_EOL;
        }

        try {
            $table = "order_type";
            $this->dropTable('{{' . $table . '}}');
        } catch (Exception $e) {
            echo "Table '" . $table ."' not found" . PHP_EOL;
        }

        try {
            $table = "product";
            $this->dropTable('{{' . $table . '}}');
        } catch (Exception $e) {
            echo "Table '" . $table ."' not found" . PHP_EOL;
        }

        try {
            $table = "product_group";
            $this->dropTable('{{' . $table . '}}');
        } catch (Exception $e) {
            echo "Table '" . $table ."' not found" . PHP_EOL;
        }
   
        $this->execute("SET foreign_key_checks = 1;");

        $auth = Yii::app()->authManager;
    
        $auth->removeAuthItem("admin:order");
        $auth->removeAuthItem("admin:order:create");
        $auth->removeAuthItem("admin:order:read");
        $auth->removeAuthItem("admin:order:update");
        $auth->removeAuthItem("admin:order:delete");

        $auth->save();

        try {
            $table = "system_template";
            $this->dropTable('{{' . $table . '}}');
        } catch (Exception $e) {
            echo "Table '" . $table ."' not found" . PHP_EOL;
        }

        $auth = Yii::app()->authManager;
    
        $auth->removeAuthItem("admin:systemTemplate");
        $auth->removeAuthItem("admin:systemTemplate:create");
        $auth->removeAuthItem("admin:systemTemplate:read");
        $auth->removeAuthItem("admin:systemTemplate:update");
        $auth->removeAuthItem("admin:systemTemplate:delete");

        $auth->save();


        $this->execute("SET foreign_key_checks = 0;");

        try {
            $table = "invoice_row";
            $this->dropTable('{{' . $table . '}}');
        } catch (Exception $e) {
            echo "Table '" . $table ."' not found" . PHP_EOL;
        }
   
        try {
            $table = "invoice";
            $this->dropTable('{{' . $table . '}}');
        } catch (Exception $e) {
            echo "Table '" . $table ."' not found" . PHP_EOL;
        }
   
        try {
            $table = "invoice_status";
            $this->dropTable('{{' . $table . '}}');
        } catch (Exception $e) {
            echo "Table '" . $table ."' not found" . PHP_EOL;
        }
   
        try {
            $table = "invoice_type";
            $this->dropTable('{{' . $table . '}}');
        } catch (Exception $e) {
            echo "Table '" . $table ."' not found" . PHP_EOL;
        }


        $this->execute("SET foreign_key_checks = 0;");

        $this->dropColumn('{{contratti_tipo}}', 'color');
        $this->dropColumn('{{contratti_tipo}}', 'prefix');
        $this->dropColumn('{{contratti_tipo}}', 'rent');
        $this->dropColumn('{{contratti_tipo}}', 'transit');
        $this->dropColumn('{{contratti_tipo}}', 'sell');
        $this->dropColumn('{{contratti_tipo}}', 'option');
        $this->dropColumn('{{contratti_tipo}}', 'manage');
        $this->dropColumn('{{contratti_tipo}}', 'reservation');
        $this->dropColumn('{{contratti_tipo}}', 'sort_order');
        $this->dropColumn('{{contratti_tipo}}', 'enabled');
        $this->dropColumn('{{contratti_tipo}}', 'create_time');
        $this->dropColumn('{{contratti_tipo}}', 'update_time');
   

        $this->execute("SET foreign_key_checks = 0;");

        $this->dropColumn('{{dimensioni}}', 'create_time');
        $this->dropColumn('{{dimensioni}}', 'update_time');

        $this->dropColumn('{{clienti}}', 'country');
        $this->dropColumn('{{clienti}}', 'create_time');
        $this->dropColumn('{{clienti}}', 'update_time');

        $this->dropColumn('{{barche}}', 'builder');
        $this->dropColumn('{{barche}}', 'insurance_company');
        $this->dropColumn('{{barche}}', 'country');
        $this->dropColumn('{{barche}}', 'create_time');
        $this->dropColumn('{{barche}}', 'update_time');

        $this->dropIndex("idx_clienti_country", "{{clienti}}");
        $this->dropIndex("idx_barche_builder", "{{barche}}");
        $this->dropIndex("idx_barche_insurance_company", "{{barche}}");
        
        $this->dropIndex("idx_barche_country", "{{barche}}");
        

    	return true;
	}

}
