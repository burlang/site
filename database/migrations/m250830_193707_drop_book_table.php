<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%book}}`.
 */
class m250830_193707_drop_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->dropTable("{{%book}}");
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $query = <<<SQL
            CREATE TABLE `book` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `title` varchar(255) NOT NULL,
                `slug` varchar(255) NOT NULL,
                `description` text DEFAULT NULL,
                `content` text DEFAULT NULL,
                `active` tinyint(1) NOT NULL,
                `created_by` int(11) NOT NULL DEFAULT 1,
                `updated_by` int(11) NOT NULL DEFAULT 1,
                `created_at` int(11) NOT NULL,
                `updated_at` int(11) NOT NULL,
                PRIMARY KEY (`id`),
                UNIQUE KEY `slug` (`slug`),
                UNIQUE KEY `idx-book-title` (`title`),
                KEY `fk-book-created_by-user-id` (`created_by`),
                KEY `fk-book-updated_by-user-id` (`updated_by`),
                CONSTRAINT `fk-book-created_by-user-id` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE,
                CONSTRAINT `fk-book-updated_by-user-id` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE CASCADE
            ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
        SQL;
        $this->execute($query);
    }
}
