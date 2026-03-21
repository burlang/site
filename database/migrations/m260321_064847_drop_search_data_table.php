<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%search_data}}`.
 */
class m260321_064847_drop_search_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->dropTable('{{%search_data}}');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->createTable('{{%search_data}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'type' => $this->boolean()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        $this->createIndex(
            'idx-search_data-name',
            '{{%search_data}}',
            'name'
        );
    }
}
