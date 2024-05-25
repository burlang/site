<?php

use yii\db\Migration;

class m160507_124345_rename_ruwords_table extends Migration
{
    /**
     * @var string
     */
    protected $tableName = '{{%ruwords}}';

    /**
     * @var string
     */
    protected $newTableName = '{{%russian_word}}';

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
