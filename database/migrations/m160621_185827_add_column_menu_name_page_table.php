<?php

use yii\db\Migration;

class m160621_185827_add_column_menu_name_page_table extends Migration
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
        $this->addColumn($this->tableName, 'menu_name', $this->string()->notNull()->after('id'));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn($this->tableName, 'menu_name');
    }
}
