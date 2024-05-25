<?php

use yii\db\Migration;

class m160816_035529_add_static_pages extends Migration
{
    /**
     * @var string
     */
    protected $tableName = '{{%page}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->truncateTable($this->tableName);

        $time = time();

        $this->insert($this->tableName, [
            'menu_name' => 'About',
            'title' => 'About',
            'link' => 'about',
            'description' => 'Description',
            'content' => 'Content',
            'active' => 0,
            'created_at' => $time,
            'updated_at' => $time,
        ]);

        $this->insert($this->tableName, [
            'menu_name' => 'Services',
            'title' => 'Translation service',
            'link' => 'translation-service',
            'description' => 'Description',
            'content' => 'Content',
            'active' => 0,
            'created_at' => $time,
            'updated_at' => $time,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->truncateTable($this->tableName);
    }
}
