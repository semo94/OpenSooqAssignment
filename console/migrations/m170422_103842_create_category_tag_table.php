<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category_tag`.
 */
class m170422_103842_create_category_tag_table extends Migration
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
        $this->createTable('category_tag', [
            'category_id' => $this->integer()->notNull(),
            'tag_id' => $this->integer()->notNull()
        ], $tableOptions);

        $this->addPrimaryKey('pk_category_tag','category_tag',array('category_id','tag_id'));

        $this->addForeignKey('fk_category_tag_category_id',
         'category_tag',
         'category_id',
         'category',
         'id',
         'RESTRICT',
         'CASCADE');

         $this->addForeignKey('fk_category_tag_tag_id',
          'category_tag',
          'tag_id',
          'tag',
          'id',
          'RESTRICT',
          'CASCADE');

          $this->insert('category_tag',['category_id'=> 1,'tag_id'=> 8]);
          $this->insert('category_tag',['category_id'=> 1,'tag_id'=> 9]);
          $this->insert('category_tag',['category_id'=> 1,'tag_id'=> 10]);
          $this->insert('category_tag',['category_id'=> 1,'tag_id'=> 11]);
          $this->insert('category_tag',['category_id'=> 1,'tag_id'=> 12]);
          $this->insert('category_tag',['category_id'=> 3,'tag_id'=> 11]);
          $this->insert('category_tag',['category_id'=> 3,'tag_id'=> 12]);
          $this->insert('category_tag',['category_id'=> 3,'tag_id'=> 13]);
          $this->insert('category_tag',['category_id'=> 3,'tag_id'=> 14]);
          $this->insert('category_tag',['category_id'=> 2,'tag_id'=> 1]);
          $this->insert('category_tag',['category_id'=> 2,'tag_id'=> 2]);
          $this->insert('category_tag',['category_id'=> 2,'tag_id'=> 3]);
          $this->insert('category_tag',['category_id'=> 2,'tag_id'=> 4]);
          $this->insert('category_tag',['category_id'=> 2,'tag_id'=> 5]);
          $this->insert('category_tag',['category_id'=> 2,'tag_id'=> 6]);
          $this->insert('category_tag',['category_id'=> 2,'tag_id'=> 7]);
          $this->insert('category_tag',['category_id'=> 2,'tag_id'=> 11]);
          $this->insert('category_tag',['category_id'=> 2,'tag_id'=> 12]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_category_tag_category_id', 'category_tag');
        $this->dropForeignKey('fk_category_tag_tag_id', 'category_tag');
        $this->dropTable('category_tag');
    }
}
