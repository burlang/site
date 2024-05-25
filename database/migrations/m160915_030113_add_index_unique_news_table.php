<?php

use yii\db\Migration;

class m160915_030113_add_index_unique_news_table extends Migration
{
    /**
     * @var string
     */
    protected $tableName = '{{%news}}';

    protected $indexName = 'idx-news-title';

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
