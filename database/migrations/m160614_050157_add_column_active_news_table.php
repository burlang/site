<?php

use yii\db\Migration;

class m160614_050157_add_column_active_news_table extends Migration
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
