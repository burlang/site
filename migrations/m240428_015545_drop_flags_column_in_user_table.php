<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%flags_column_in_user}}`.
 */
class m240428_015545_drop_flags_column_in_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->dropColumn('{{%user}}', 'flags');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->addColumn(
            '{{%user}}',
            'flags',
            $this->integer()
                ->notNull()
                ->defaultValue(0)
                ->after('updated_at')
        );
    }
}
