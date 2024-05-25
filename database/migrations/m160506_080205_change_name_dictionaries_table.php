<?php

use yii\db\Migration;

class m160506_080205_change_name_dictionaries_table extends Migration
{
    /**
     * @var string
     */
    protected $tableName = '{{%dictionaries}}';

    /**
     * @var string
     */
    protected $newTableName = '{{%dictionary}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->renameTable($this->tableName, $this->newTableName);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->renameTable($this->newTableName, $this->tableName);
    }
}
