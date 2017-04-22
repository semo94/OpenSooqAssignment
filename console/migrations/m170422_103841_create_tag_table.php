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
            'name' => $this->string(100)->notNull()->unique()
        ], $tableOptions);

        $this->insert('tag',['name'=>'toyota']
        );
        $this->insert('tag',['name'=>'honda']
        );
        $this->insert('tag',['name'=>'gmc']
        );
        $this->insert('tag',['name'=>'automatic']
        );
        $this->insert('tag',['name'=>'manual']
        );
        $this->insert('tag',['name'=>'hybrid']
        );
        $this->insert('tag',['name'=>'gas']
        );
        $this->insert('tag',['name'=>'iphone']
        );
        $this->insert('tag',['name'=>'galaxy s']
        );
        $this->insert('tag',['name'=>'galaxy note']
        );
        $this->insert('tag',['name'=>'black']
        );
        $this->insert('tag',['name'=>'white']
        );
        $this->insert('tag',['name'=>'ipad']
        );
        $this->insert('tag',['name'=>'galaxy tab']
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
