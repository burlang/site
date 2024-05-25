<?php

use yii\db\Migration;

class m160604_170754_add_index_russian_word_table extends Migration
{
    /**
     * @var string
     */
    protected $tableName = '{{%russian_word}}';

    /**
     * @var string
     */
    protected $indexName = 'idx-russian_word-name';

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
