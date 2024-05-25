<?php

use yii\db\Migration;

class m161010_014929_add_columns_book_table extends Migration
{
    /**
     * @var string
     */
    protected $tableName = '{{%book}}';

    /**
     * @var string
     */
    protected $fkNameCreatedBy = 'fk-book-created_by-user-id';

    /**
     * @var string
     */
    protected $fkNameUpdatedBy = 'fk-book-updated_by-user-id';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn($this->tableName, 'created_by', $this->integer()->notNull()->defaultValue(1)->after('active'));
        $this->addColumn($this->tableName, 'updated_by', $this->integer()->notNull()->defaultValue(1)->after('created_by'));

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
    }
}
