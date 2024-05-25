<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%buryat_word_temp}}`.
 */
class m220102_103339_drop_buryat_word_temp_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->dropTable('{{%buryat_word_temp}}');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->createTable('{{%buryat_word_temp}}', [
            'id' => $this->primaryKey(),
        ]);
    }
}
