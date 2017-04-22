<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin`.
 */
class m170420_231207_create_admin_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('admin', [
            'id' => $this->primaryKey(),
            'username' => $this->string(64)->notNull()->unique(),
            'password_hash' => $this->string(255)->notNull(),
            'auth_key' => $this->string(255)->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'updated_at' => 'timestamp ON UPDATE CURRENT_TIMESTAMP',
            'created_at' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP'
        ], $tableOptions);

        $this->insert('admin', array(
         'username'=>'admin',
         'status'=> 10,
         'password_hash' => '$2y$13$PTmOcM4IANsbrX8K/5X2XuoK24j3G8zx5k6eXWhkkAnNtW17Vg.im',
         'auth_key' => '1Z8N-KBqEWEIH-iD7zllqsUYqev1Q63d'
        ));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('admin');
    }
}
