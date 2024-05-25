<?php

use yii\db\Migration;

class m160506_084256_rename_burwords_table extends Migration
{
    /**
     * @var string
     */
    protected $tableName = '{{%burwords}}';

    /**
     * @var string
     */
    protected $newTableName = '{{%buryat_word}}';

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
