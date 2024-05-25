<?php

use yii\db\Migration;

class m160604_165736_add_index_buryat_word_table extends Migration
{
    /**
     * @var string
     */
    protected $tableName = '{{%buryat_word}}';

    /**
     * @var string
     */
    protected $indexName = 'idx-buryat_word-name';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createIndex($this->indexName, $this->tableName, 'name');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex($this->indexName, $this->tableName);
    }
}
