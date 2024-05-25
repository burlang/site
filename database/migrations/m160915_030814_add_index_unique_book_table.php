<?php

use yii\db\Migration;

class m160915_030814_add_index_unique_book_table extends Migration
{
    /**
     * @var string
     */
    protected $tableName = '{{%book}}';

    protected $indexName = 'idx-book-title';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createIndex($this->indexName, $this->tableName, 'title', true);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex($this->indexName, $this->tableName);
    }
}
