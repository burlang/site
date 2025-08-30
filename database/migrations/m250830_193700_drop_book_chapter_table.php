<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%book_chapter}}`.
 */
class m250830_193700_drop_book_chapter_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->dropTable("{{%book_chapter}}");
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $query = <<<SQL
            CREATE TABLE `book_chapter` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `title` varchar(255) NOT NULL,
                `slug` varchar(255) NOT NULL,
                `content` text DEFAULT NULL,
                `book_id` int(11) NOT NULL,
                `created_by` int(11) NOT NULL DEFAULT 1,
                `updated_by` int(11) NOT NULL DEFAULT 1,
                `created_at` int(11) NOT NULL,
                `updated_at` int(11) NOT NULL,
                PRIMARY KEY (`id`),
                KEY `book_chapter-book_id-book-id` (`book_id`),
                KEY `fk-book_chapter-created_by-user-id` (`created_by`),
                KEY `fk-book_chapter-updated_by-user-id` (`updated_by`),
                CONSTRAINT `book_chapter-book_id-book-id` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE,
                CONSTRAINT `fk-book_chapter-created_by-user-id` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE,
                CONSTRAINT `fk-book_chapter-updated_by-user-id` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE CASCADE
            ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
        SQL;
        $this->execute($query);
    }
}
