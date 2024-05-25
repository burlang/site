<?php

use yii\db\Migration;

class m240428_012942_drop_token_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->dropTable('{{%token}}');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->db->createCommand(
            <<<SQL
CREATE TABLE `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL,
  UNIQUE KEY `token_unique` (`user_id`,`code`,`type`),
  CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
SQL
        )->execute();
    }
}
