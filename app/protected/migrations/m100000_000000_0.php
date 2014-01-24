<?php

class m100000_000000_0 extends CDbMigration
{
	public function safeUp()
	{

        $this->execute("ALTER TABLE {{assicurazioni}} ENGINE = InnoDB");
        $this->execute("ALTER TABLE {{assicurazioni}} ENGINE = InnoDB");
        $this->execute("ALTER TABLE {{barche}} ENGINE = InnoDB");
        $this->execute("ALTER TABLE {{barche_trasferimenti}} ENGINE = InnoDB");
        $this->execute("ALTER TABLE {{clienti}} ENGINE = InnoDB");
        $this->execute("ALTER TABLE {{clienti_note}} ENGINE = InnoDB");
        $this->execute("ALTER TABLE {{contratti}} ENGINE = InnoDB");
        $this->execute("ALTER TABLE {{contratti_periodi}} ENGINE = InnoDB");
        $this->execute("ALTER TABLE {{contratti_tipo}} ENGINE = InnoDB");
        $this->execute("ALTER TABLE {{contratti_dettagli}} ENGINE = InnoDB");
        $this->execute("ALTER TABLE {{costruttori}} ENGINE = InnoDB");
        $this->execute("ALTER TABLE {{dimensioni}} ENGINE = InnoDB");
        $this->execute("ALTER TABLE {{nazioni}} ENGINE = InnoDB");
        $this->execute("ALTER TABLE {{pontili}} ENGINE = InnoDB");
        $this->execute("ALTER TABLE {{pontili_tipo}} ENGINE = InnoDB");
        $this->execute("ALTER TABLE {{posti_barca}} ENGINE = InnoDB");
        $this->execute("ALTER TABLE {{tipologie_barche}} ENGINE = InnoDB");
        $this->execute("ALTER TABLE {{scadenze}} ENGINE = InnoDB");
        $this->execute("ALTER TABLE {{utenti}} ENGINE = InnoDB");
        $this->execute("ALTER TABLE {{posti_barca_status}} ENGINE = InnoDB");
        $this->execute("ALTER TABLE {{listini_posti_barca}} ENGINE = InnoDB");
        $this->execute("ALTER TABLE {{listini_generici}} ENGINE = InnoDB");
        $this->execute("ALTER TABLE {{fatture}} ENGINE = InnoDB");
        $this->execute("ALTER TABLE {{fatture_righe}} ENGINE = InnoDB");
        $this->execute("ALTER TABLE {{presenze}} ENGINE = InnoDB");
        $this->execute("ALTER TABLE {{prima_nota}} ENGINE = InnoDB");
        $this->execute("ALTER TABLE {{province}} ENGINE = InnoDB");

		$this->createTable('{{user}}', array(
			"id" => "INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ",
			"name" => "VARCHAR(255) NOT NULL DEFAULT ''",
			"username" => "VARCHAR(255) NOT NULL DEFAULT ''",
			"password" => "VARCHAR(255) NOT NULL DEFAULT ''",
			"role" => "VARCHAR(255) NOT NULL DEFAULT ''",
			"tstamp" => "TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP",
		), 'ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci');
		
		$this->createIndex("idx_uniq_username", "{{user}}", "username", true);
        $this->insert("{{user}}", array('username' => 'administrator', 'password' => crypt('password'), 'role' => json_encode(array('ADMIN')), 'name' => 'Amministratore'));
		$this->insert("{{user}}", array('username' => 'simpleuser', 'password' => crypt('simpleuser'), 'role' => json_encode(array('USER')), 'name' => 'Simple user'));

        $this->createTable('{{auth_item}}', array(
            "name" => "VARCHAR(64) NOT NULL PRIMARY KEY",
            "type" => "INTEGER NOT NULL",
            "description" => "TEXT",
            "bizrule" => "TEXT",
            "data" => "TEXT",
        ), 'ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci');
        
        $this->createTable('{{auth_item_child}}', array(
            "parent" => "VARCHAR(64) NOT NULL",
            "child" => "VARCHAR(64) NOT NULL",
        ), 'ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci');

        $this->addPrimaryKey('pk_parent_child', "{{auth_item_child}}", 'parent,child');
        // Always use DB_TABLE_PREFIX in foreing key name to avoid conflict in MySQL
        $this->addForeignKey('fk_parent_' . DB_TABLE_PREFIX . 'auth_item_name', '{{auth_item_child}}', 'parent', "{{auth_item}}", "name", 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_child_' . DB_TABLE_PREFIX . 'auth_item_name', '{{auth_item_child}}', 'child', "{{auth_item}}", "name", 'CASCADE', 'CASCADE');

        $this->createTable('{{auth_assignment}}', array(
            "itemname"  => "VARCHAR(64) NOT NULL",
            "userid"    => "VARCHAR(64) NOT NULL",
            "bizrule"   => "TEXT",
            "data"      => "TEXT",
        ), 'ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci');

        $this->addPrimaryKey('pk_itemname_userid', "{{auth_assignment}}", 'itemname,userid');
        $this->addForeignKey('fk_' . DB_TABLE_PREFIX . 'itemname', '{{auth_assignment}}', 'itemname', "{{auth_item}}", "name", 'CASCADE', 'CASCADE');

        $auth = Yii::app()->authManager;

        // Roles must be UPPERCASE
        $role_admin = $auth->createRole('ADMIN', 'Main administrator');
        $role_user = $auth->createRole('USER', 'Default user');

        // Task contains atomic operations
        $user = $auth->createTask("admin:user", Yii::t('app', 'Users administration'));
        $auth->createOperation("admin:user:create", Yii::t('app', 'Create'));
        $auth->createOperation("admin:user:read", Yii::t('app', 'Read'));
        $auth->createOperation("admin:user:update", Yii::t('app', 'Update'));
        $auth->createOperation("admin:user:delete", Yii::t('app', 'Delete'));
        
        // Connect operation to parent task
        $user->addChild('admin:user:create');
        $user->addChild('admin:user:read');
        $user->addChild('admin:user:update');
        $user->addChild('admin:user:delete');

        // Allow this operations to role
        $role_admin->addChild('admin:user:create');
        $role_admin->addChild('admin:user:read');
        $role_admin->addChild('admin:user:update');
        $role_admin->addChild('admin:user:delete');

        $task = $auth->createTask("main:search", Yii::t('app', 'Main search'));
        $auth->createOperation('main:search:allow', Yii::t('app', 'Allow'));
        $task->addChild('main:search:allow');
        
        $role_admin->addChild('main:search:allow');

        $auth->save();
        
		return true;
	}

	public function safeDown()
	{

        $this->execute("SET foreign_key_checks = 0;");

        try {
            $this->dropTable('{{user}}');
        } catch (Exception $e) {
            echo "Table 'user' not found" . PHP_EOL;
        }
        try {
            $this->dropTable('{{auth_item}}');
        } catch (Exception $e) {
            echo "Table 'auth_item' not found" . PHP_EOL;
        }
        try {
            $this->dropTable('{{auth_item_child}}');
        } catch (Exception $e) {
            echo "Table 'auth_item_child' not found" . PHP_EOL;
        }
        try {
            $this->dropTable('{{auth_assignment}}');
        } catch (Exception $e) {
            echo "Table 'auth_assignment' not found" . PHP_EOL;
        }

        $this->execute("ALTER TABLE {{assicurazioni}} ENGINE = MyISAM");
        $this->execute("ALTER TABLE {{assicurazioni}} ENGINE = MyISAM");
        $this->execute("ALTER TABLE {{barche}} ENGINE = MyISAM");
        $this->execute("ALTER TABLE {{barche_trasferimenti}} ENGINE = MyISAM");
        $this->execute("ALTER TABLE {{clienti}} ENGINE = MyISAM");
        $this->execute("ALTER TABLE {{clienti_note}} ENGINE = MyISAM");
        $this->execute("ALTER TABLE {{contratti}} ENGINE = MyISAM");
        $this->execute("ALTER TABLE {{contratti_periodi}} ENGINE = MyISAM");
        $this->execute("ALTER TABLE {{contratti_tipo}} ENGINE = MyISAM");
        $this->execute("ALTER TABLE {{contratti_dettagli}} ENGINE = MyISAM");
        $this->execute("ALTER TABLE {{costruttori}} ENGINE = MyISAM");
        $this->execute("ALTER TABLE {{dimensioni}} ENGINE = MyISAM");
        $this->execute("ALTER TABLE {{nazioni}} ENGINE = MyISAM");
        $this->execute("ALTER TABLE {{pontili}} ENGINE = MyISAM");
        $this->execute("ALTER TABLE {{pontili_tipo}} ENGINE = MyISAM");
        $this->execute("ALTER TABLE {{posti_barca}} ENGINE = MyISAM");
        $this->execute("ALTER TABLE {{tipologie_barche}} ENGINE = MyISAM");
        $this->execute("ALTER TABLE {{scadenze}} ENGINE = MyISAM");
        $this->execute("ALTER TABLE {{utenti}} ENGINE = MyISAM");
        $this->execute("ALTER TABLE {{posti_barca_status}} ENGINE = MyISAM");
        $this->execute("ALTER TABLE {{listini_posti_barca}} ENGINE = MyISAM");
        $this->execute("ALTER TABLE {{listini_generici}} ENGINE = MyISAM");
        $this->execute("ALTER TABLE {{fatture}} ENGINE = MyISAM");
        $this->execute("ALTER TABLE {{fatture_righe}} ENGINE = MyISAM");
        $this->execute("ALTER TABLE {{presenze}} ENGINE = MyISAM");
        $this->execute("ALTER TABLE {{prima_nota}} ENGINE = MyISAM");
        $this->execute("ALTER TABLE {{province}} ENGINE = MyISAM");

        $this->execute("SET foreign_key_checks = 1;");
	
    	return true;
	}

}
