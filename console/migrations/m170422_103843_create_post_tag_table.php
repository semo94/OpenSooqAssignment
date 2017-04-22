<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post_tag`.
 */
class m170422_103843_create_post_tag_table extends Migration
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
        $this->createTable('post_tag', [
            'post_id' => $this->integer()->notNull(),
            'tag_id' => $this->integer()->notNull()
        ], $tableOptions);

        $this->addPrimaryKey('pk_post_tag','post_tag',array('post_id','tag_id'));

        $this->addForeignKey('fk_post_tag_post_id',
         'post_tag',
         'post_id',
         'post',
         'id',
         'RESTRICT',
         'CASCADE');

         $this->addForeignKey('fk_post_tag_tag_id',
          'post_tag',
          'tag_id',
          'tag',
          'id',
          'RESTRICT',
          'CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_post_tag_post_id', 'post_tag');
        $this->dropForeignKey('fk_post_tag_tag_id', 'post_tag');
        $this->dropTable('post_tag');
    }
}
