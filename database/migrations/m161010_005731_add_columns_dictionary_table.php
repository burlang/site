<?php

use yii\db\Migration;

class m161010_005731_add_columns_dictionary_table extends Migration
{
    /**
     * @var string
     */
    protected $tableName = '{{%dictionary}}';

    /**
     * @var string
     */
    protected $fkNameCreatedBy = 'fk-dictionary-created_by-user-id';

    /**
     * @var string
     */
    protected $fkNameUpdatedBy = 'fk-dictionary-updated_by-user-id';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn($this->tableName, 'created_by', $this->integer()->notNull()->defaultValue(1));
        $this->addColumn($this->tableName, 'updated_by', $this->integer()->notNull()->defaultValue(1));

        $time = time();
        $this->addColumn($this->tableName, 'created_at', $this->integer()->notNull()->defaultValue($time));
        $this->addColumn($this->tableName, 'updated_at', $this->integer()->notNull()->defaultValue($time));

        $this->addForeignKey($this->fkNameCreatedBy, $this->tableName, 'created_by', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey($this->fkNameUpdatedBy, $this->tableName, 'updated_by', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey($this->fkNameCreatedBy, $this->tableName);
        $this->dropForeignKey($this->fkNameUpdatedBy, $this->tableName);

        $this->dropColumn($this->tableName, 'created_by');
        $this->dropColumn($this->tableName, 'updated_by');

        $this->dropColumn($this->tableName, 'created_at');
        $this->dropColumn($this->tableName, 'updated_at');
    }
}
