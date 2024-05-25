<?php

use yii\db\Migration;

class m160616_082824_add_column_content_book_table extends Migration
{
    /**
     * @var string
     */
    protected $tableName = '{{%book}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn($this->tableName, 'content', $this->text()->after('description'));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn($this->tableName, 'content');
    }
}
