<?php

use yii\db\Migration;

class m161010_015741_add_columns_book_chapter_table extends Migration
{
    /**
     * @var string
     */
    protected $tableName = '{{%book_chapter}}';

    /**
     * @var string
     */
    protected $fkNameCreatedBy = 'fk-book_chapter-created_by-user-id';

    /**
     * @var string
     */
    protected $fkNameUpdatedBy = 'fk-book_chapter-updated_by-user-id';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn($this->tableName, 'created_by', $this->integer()->notNull()->defaultValue(1)->after('book_id'));
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
