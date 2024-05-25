<?php

use yii\db\Migration;

/**
 * Class m220115_191102_drop_rbac_tables
 */
class m220115_191102_drop_rbac_tables extends Migration
{
    /**
     * {@inheritDoc}
     */
    public function up()
    {
        $this->dropTable('auth_assignment');
        $this->dropTable('auth_item_child');
        $this->dropTable('auth_item');
        $this->dropTable('auth_rule');
    }

    /**
     * {@inheritDoc}
     */
    public function down()
    {
        echo "m220115_191102_drop_rbac_tables cannot be reverted.\n";

        return false;
    }
}
