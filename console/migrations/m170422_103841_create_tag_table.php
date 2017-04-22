<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tag`.
 */
class m170422_103841_create_tag_table extends Migration
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
        $this->createTable('tag', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'name' => $this->string(100)->notNull()
        ], $tableOptions);

        $this->addForeignKey('fk_tag_category_id',
         'tag',
         'category_id',
         'category',
         'id',
         'RESTRICT',
         'CASCADE');

        $this->insert('tag',['name'=>'toyota','category_id'=>2]
        );
        $this->insert('tag',['name'=>'honda','category_id'=>2]
        );
        $this->insert('tag',['name'=>'gmc','category_id'=>2]
        );
        $this->insert('tag',['name'=>'automatic','category_id'=>2]
        );
        $this->insert('tag',['name'=>'manual','category_id'=>2]
        );
        $this->insert('tag',['name'=>'hybrid','category_id'=>2]
        );
        $this->insert('tag',['name'=>'gas','category_id'=>2]
        );
        $this->insert('tag',['name'=>'iphone','category_id'=>1]
        );
        $this->insert('tag',['name'=>'galaxy s','category_id'=>1]
        );
        $this->insert('tag',['name'=>'galaxy note','category_id'=>1]
        );
        $this->insert('tag',['name'=>'black','category_id'=>1]
        );
        $this->insert('tag',['name'=>'white','category_id'=>1]
        );
        $this->insert('tag',['name'=>'black','category_id'=>2]
        );
        $this->insert('tag',['name'=>'white','category_id'=>2]
        );
        $this->insert('tag',['name'=>'black','category_id'=>3]
        );
        $this->insert('tag',['name'=>'white','category_id'=>3]
        );
        $this->insert('tag',['name'=>'ipad','category_id'=>3]
        );
        $this->insert('tag',['name'=>'galaxy tab','category_id'=>3]
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tag');
    }
}
