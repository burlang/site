<?php

use yii\db\Migration;

class m160427_063743_delete_incorrect_data extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        Yii::$app->db->createCommand('DELETE FROM rutranslations WHERE id=2609 OR id=2140')->execute();
        Yii::$app->db->createCommand('DELETE FROM ruwords WHERE id=10904')->execute();
        Yii::$app->db->createCommand('DELETE FROM burwords WHERE id=2140 OR id=10')->execute();
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
    }
}
