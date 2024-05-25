<?php

use yii\db\Migration;

class m160401_023234_add_column_description_for_news_table extends Migration
{
    /**
     * @var string
     */
    protected $tableName = '{{%news}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn($this->tableName, 'description', $this->text() . ' AFTER title');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn($this->tableName, 'description');
    }
}
