<?php

use yii\db\Migration;

class m160517_053135_add_column_link_page_table extends Migration
{
    /**
     * @var string
     */
    protected $tableName = '{{%page}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn($this->tableName, 'link', $this->string(100)->notNull()->after('title')->unique());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn($this->tableName, 'link');
    }
}
