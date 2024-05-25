<?php

use yii\db\Migration;

class m240428_092807_add_role_colunm_in_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn(
            '{{%user}}',
            'role',
            $this->string(60)
                ->notNull()
                ->after('auth_key')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropColumn('{{%user}}', 'role');
    }
}
