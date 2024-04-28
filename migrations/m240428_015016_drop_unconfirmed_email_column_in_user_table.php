<?php

use yii\db\Migration;

class m240428_015016_drop_unconfirmed_email_column_in_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->dropColumn('{{%user}}', 'unconfirmed_email');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->addColumn(
            '{{%user}}', 
            'unconfirmed_email',
            $this->string(255)
                ->after('confirmed_at')
        );
    }
}
