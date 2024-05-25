<?php

use yii\db\Migration;

class m160604_170915_add_index_buryat_name_table extends Migration
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
