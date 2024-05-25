<?php

use yii\db\Migration;

class m160903_033853_add_index_unique_buryat_word_table extends Migration
{
    /**
     * @var string
     */
    protected $tableName = '{{%buryat_word}}';

    /**
     * @var string
     */
    protected $indexName = 'idx-buryat_word-name';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $connection = Yii::$app->db;
        $words = $connection->createCommand(
            'SELECT name FROM buryat_word GROUP BY name HAVING COUNT(*) > 1'
        )->queryAll();

        foreach ($words as $word) {
            $d_word = $connection->createCommand(
                'SELECT * FROM buryat_word WHERE name=:name',
                [':name' => $word['name']]
            )->queryAll();
            $ids = \yii\helpers\ArrayHelper::getColumn($d_word, 'id');
            $id = array_shift($ids);
            $connection->createCommand()->update(
                'buryat_translation',
                ['burword_id' => $id],
                ['in', 'burword_id', $ids]
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
