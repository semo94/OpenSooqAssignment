<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m170422_103840_create_category_table extends Migration
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
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'name' => $this->string(64)->notNull()->unique()
        ], $tableOptions);

        $this->insert('category',['name'=>'Mobiles']
        );
        $this->insert('category',['name'=>'Cars']
        );
        $this->insert('category',['name'=>'Tablets']
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('category');
    }
}
