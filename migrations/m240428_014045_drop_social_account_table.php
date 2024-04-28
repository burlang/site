<?php

use yii\db\Migration;

class m240428_014045_drop_social_account_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->dropTable('{{%social_account}}');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->db->createCommand(
            <<<SQL
CREATE TABLE `social_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `data` text DEFAULT NULL,
  `code` varchar(32) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_unique` (`provider`,`client_id`),
  UNIQUE KEY `account_unique_code` (`code`),
  KEY `fk_user_account` (`user_id`),
  CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
SQL
        )->execute();
    }
}
