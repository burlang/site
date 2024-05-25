<?php

use yii\db\Migration;

class m160427_040432_delete_column_desc_rutranslation_table extends Migration
{
    /**
     * @var string
     */
    protected $tableName = '{{%rutranslations}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn($this->tableName, 'description');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->addColumn($this->tableName, 'description', $this->text());
    }
}
