<?php

use yii\db\Migration;

class m160518_075441_alter_column_page_table extends Migration
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
        $this->alterColumn($this->tableName, 'description', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->alterColumn($this->tableName, 'description', $this->string()->notNull());
    }
}
