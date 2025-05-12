<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%page}}`.
 */
class m250512_014324_drop_page_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->dropTable('{{%page}}');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $query = <<<SQL
        CREATE TABLE `page` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `menu_name` varchar(255) NOT NULL,
          `title` varchar(255) NOT NULL,
          `link` varchar(100) NOT NULL,
          `description` varchar(255) DEFAULT NULL,
          `content` text NOT NULL,
          `active` tinyint(1) NOT NULL,
          `static` tinyint(1) NOT NULL,
          `created_by` int(11) NOT NULL DEFAULT 1,
          `updated_by` int(11) NOT NULL DEFAULT 1,
          `created_at` int(11) NOT NULL,
          `updated_at` int(11) NOT NULL,
          PRIMARY KEY (`id`),
          UNIQUE KEY `link` (`link`),
          KEY `fk-page-created_by-user-id` (`created_by`),
          KEY `fk-page-updated_by-user-id` (`updated_by`),
          CONSTRAINT `fk-page-created_by-user-id` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE,
          CONSTRAINT `fk-page-updated_by-user-id` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
SQL;
        $this->execute($query);
    }
}
