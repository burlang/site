<?php

use yii\db\Migration;

class m160903_033307_fixed_index_buryat_name_table extends Migration
{
    /**
     * @var string
     */
    protected $tableName = '{{%buryat_name}}';

    /**
     * @var string
     */
    protected $indexName = 'idx-buryat_name-name';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->dropIndex('name', $this->tableName);
        $this->dropIndex($this->indexName, $this->tableName);
        $this->createIndex($this->indexName, $this->tableName, 'name', true);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropIndex($this->indexName, $this->tableName);
        $this->createIndex($this->indexName, $this->tableName, 'name');
        $this->createIndex('name', $this->tableName, 'name', true);
    }
}
