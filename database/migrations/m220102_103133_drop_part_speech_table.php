<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%part_speech}}`.
 */
class m220102_103133_drop_part_speech_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->dropTable('{{%part_speech}}');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->createTable('{{%part_speech}}', [
            'id' => $this->primaryKey(),
        ]);
    }
}
