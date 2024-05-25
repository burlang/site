<?php

use yii\db\Migration;

/**
 * Handles the creation for table `book`.
 */
class m160615_184140_create_book_table extends Migration
{
    /**
     * @var string
     */
    protected $tableName = '{{%book}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'active' => $this->boolean()->notNull(),
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
