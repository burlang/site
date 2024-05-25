<?php

use yii\db\Migration;

/**
 * Handles the creation for table `book_chapter`.
 */
class m160615_195721_create_book_chapter_table extends Migration
{
    /**
     * @var string
     */
    protected $tableName = '{{%book_chapter}}';

    /**
     * @var string
     */
    protected $fkName = 'book_chapter-book_id-book-id';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'content' => $this->text(),
            'book_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey($this->fkName, $this->tableName, 'book_id', '{{%book}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey($this->fkName, $this->tableName);
        $this->dropTable($this->tableName);
    }
}
