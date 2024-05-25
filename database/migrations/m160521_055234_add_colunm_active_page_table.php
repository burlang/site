<?php

use yii\db\Migration;

class m160521_055234_add_colunm_active_page_table extends Migration
{
    /**
     * @var string
     */
    protected $tableName = '{{%page}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn($this->tableName, 'active', $this->boolean()->notNull()->after('content'));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn($this->tableName, 'active');
    }
}
