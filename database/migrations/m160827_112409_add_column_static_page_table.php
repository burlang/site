<?php

use yii\db\Migration;

class m160827_112409_add_column_static_page_table extends Migration
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
        $this->addColumn($this->tableName, 'static', $this->boolean()->notNull()->after('active'));
        $this->update($this->tableName, ['static' => 1], ['or', ['link' => 'about'], ['link' => 'services']]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn($this->tableName, 'static');
    }
}
