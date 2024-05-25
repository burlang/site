<?php

use yii\db\Migration;

class m160630_164523_add_column_slug_book_chapter extends Migration
{
    /**
     * @var string
     */
    protected $tableName = '{{%book_chapter}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn($this->tableName, 'slug', $this->string()->notNull()->after('title'));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn($this->tableName, 'slug');
    }
}
