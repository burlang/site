<?php

use yii\db\Migration;

/**
 * Class m211116_175956_add_column_dict_id_in_russian_translation_table
 */
class m211116_175956_add_column_dict_id_in_russian_translation_table extends Migration
{
    /**
     * @var string
     */
    private $tableName = '{{%russian_translation}}';
    /**
     * @var string
     */
    private $columnName = 'dict_id';

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn(
            $this->tableName,
            $this->columnName,
            $this->integer()->null()->after('name')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropColumn(
            $this->tableName,
            $this->columnName
        );
    }
}
