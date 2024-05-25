<?php

use yii\db\Migration;

/**
 * Class m211116_175109_add_column_dict_id_in_russia_word_table
 */
class m211116_175109_add_column_dict_id_in_russia_word_table extends Migration
{
    /**
     * @var string
     */
    private $tableName = '{{%russian_word}}';
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
