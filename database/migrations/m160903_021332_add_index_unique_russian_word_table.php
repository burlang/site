<?php

use yii\db\Migration;

class m160903_021332_add_index_unique_russian_word_table extends Migration
{
    /**
     * @var string
     */
    protected $tableName = '{{%russian_word}}';

    /**
     * @var string
     */
    protected $indexName = 'idx-russian_word-name';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $connection = Yii::$app->db;
        $words = $connection->createCommand(
            'SELECT name FROM russian_word GROUP BY name HAVING COUNT(*) > 1'
        )->queryAll();

        foreach ($words as $word) {
            $d_word = $connection->createCommand(
                'SELECT * FROM russian_word WHERE name=:name',
                [':name' => $word['name']]
            )->queryAll();
            $ids = \yii\helpers\ArrayHelper::getColumn($d_word, 'id');
            $id = array_shift($ids);
            $connection->createCommand()->update(
                'russian_translation',
                ['ruword_id' => $id],
                ['in', 'ruword_id', $ids]
            )->execute();
            $connection->createCommand()->delete($this->tableName, ['in', 'id', $ids])->execute();
        }

        $this->dropIndex($this->indexName, $this->tableName);
        $this->createIndex($this->indexName, $this->tableName, 'name', true);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropIndex($this->indexName, $this->tableName);
        $this->createIndex($this->indexName, $this->tableName, 'name');
    }
}
