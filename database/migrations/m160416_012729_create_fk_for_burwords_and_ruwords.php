<?php

use yii\db\Migration;

class m160416_012729_create_fk_for_burwords_and_ruwords extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        Yii::$app->db->createCommand('DELETE FROM rutranslations WHERE id>=7161 AND id<=7238')->execute();
        Yii::$app->db->createCommand('DELETE FROM rutranslations WHERE id=1161 OR id=1368')->execute();
        Yii::$app->db->createCommand('DELETE FROM burwords WHERE id=1161 OR id=1368')->execute();

        $this->addForeignKey('fk-burtranslations-ruword_id-ruwords-id', '{{%burtranslations}}', 'ruword_id', '{{%ruwords}}', 'id', 'CASCADE', 'RESTRICT');
        $this->dropIndex('burword_id', '{{%rutranslations}}');
        $this->addForeignKey('fk-rutranslations-burword_id-burwords-id', '{{%rutranslations}}', 'burword_id', '{{%burwords}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->createIndex('burword_id', '{{%rutranslations}}', 'burword_id');
        $this->dropForeignKey('fk-burtranslations-ruword_id-ruwords-id', '{{%burtranslations}}');
        $this->dropForeignKey('fk-rutranslations-burword_id-burwords-id', '{{%rutranslations}}');
    }
}
