<?php

use yii\db\Migration;

class m160625_052955_add_column_slug_book_table extends Migration
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
        $this->addColumn($this->tableName, 'slug', $this->string()->notNull()->unique()->after('title'));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn($this->tableName, 'slug');
    }
}
