<?php

use yii\db\Migration;

/**
 * Handles the creation for table `search_data`.
 */
class m161013_153111_create_search_data_table extends Migration
{
    /**
     * @var string
     */
    protected $tableName = '{{%search_data}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'type' => $this->boolean()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
