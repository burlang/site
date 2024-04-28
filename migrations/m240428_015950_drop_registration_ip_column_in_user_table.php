<?php

use yii\db\Migration;

class m240428_015950_drop_registration_ip_column_in_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->dropColumn('{{%user}}', 'registration_ip');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->addColumn(
            '{{%user}}',
            'registration_ip',
            $this->string(45)
                ->after('blocked_at')
        );
    }
}
