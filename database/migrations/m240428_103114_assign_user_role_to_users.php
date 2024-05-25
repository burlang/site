<?php

use yii\db\Migration;

class m240428_103114_assign_user_role_to_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->update('{{%user}}', ['role' => 'user']);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->update('{{%user}}', ['role' => '']);
    }
}
