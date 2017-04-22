<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post`.
 */
class m170422_103843_create_post_table extends Migration
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
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->string(),
            'user_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'updated_at' => 'timestamp ON UPDATE CURRENT_TIMESTAMP',
            'created_at' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP'
        ], $tableOptions);

        $this->addForeignKey('fk_post_user_id',
         'post',
         'user_id',
         'user',
         'id',
         'RESTRICT',
         'CASCADE');

         $this->addForeignKey('fk_post_category_id',
          'post',
          'category_id',
          'category',
          'id',
          'RESTRICT',
          'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_post_user_id', 'post');
        $this->dropForeignKey('fk_post_category_id', 'post');
        $this->dropTable('post');
    }
}
