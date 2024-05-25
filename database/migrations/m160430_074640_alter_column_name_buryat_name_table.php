<?php

use yii\db\Migration;

class m160430_074640_alter_column_name_buryat_name_table extends Migration
{
    /**
     * @var string
     */
    protected $tableName = '{{%buryat_name}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->alterColumn($this->tableName, 'name', $this->string(50)->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->alterColumn($this->tableName, 'name', $this->string()->notNull());
    }
}
