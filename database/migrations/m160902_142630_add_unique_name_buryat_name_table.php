<?php

use yii\db\Migration;

class m160902_142630_add_unique_name_buryat_name_table extends Migration
{
    /**
     * @var string
     */
    protected $tableName = '{{%buryat_name}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        Yii::$app->db->createCommand('DELETE FROM buryat_name WHERE id=970')->execute();
        $this->createIndex('name', $this->tableName, 'name', true);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex('name', $this->tableName);
    }
}
