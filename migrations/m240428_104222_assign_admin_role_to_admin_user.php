<?php

use yii\db\Migration;

class m240428_104222_assign_admin_role_to_admin_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->update('{{%user}}', ['role' => 'admin'], ['username' => 'admin']);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->update('{{%user}}', ['role' => 'user'], ['username' => 'admin']);
    }
}
