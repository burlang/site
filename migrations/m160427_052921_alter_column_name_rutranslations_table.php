<?php

use yii\db\Migration;

class m160427_052921_alter_column_name_rutranslations_table extends Migration
{

    protected $tableName = '{{%rutranslations}}';

    public function safeUp()
    {
        $this->alterColumn($this->tableName, 'name', $this->string(2000)->notNull());
    }

    public function safeDown()
    {
        $this->alterColumn($this->tableName, 'name', $this->string(2000));
    }
}
