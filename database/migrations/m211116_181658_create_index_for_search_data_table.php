<?php

use yii\db\Migration;

class m211116_181658_create_index_for_search_data_table extends Migration
{
    /**
     * @var string
     */
    private $tableName = '{{%search_data}}';
    /**
     * @var string
     */
    private $indexName = 'idx-search_data-name';

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createIndex(
            $this->indexName,
            $this->tableName,
            'name'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropIndex(
            $this->indexName,
            $this->tableName
        );
    }
}
