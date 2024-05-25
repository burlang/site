<?php

use yii\db\Migration;

/**
 * Class m211116_173701_add_default_dictionary_for_buryat_words
 */
class m211116_173701_add_default_dictionary_for_buryat_words extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $firstDictionaryId = $this->getDb()
            ->createCommand('SELECT id FROM dictionary ORDER BY id LIMIT 1')
            ->queryScalar();
        if ($firstDictionaryId) {
            $this->execute(
                'UPDATE buryat_word SET dict_id = :dict_id',
                [':dict_id' => $firstDictionaryId]
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->execute(
            'UPDATE buryat_word SET dict_id = :dict_id',
            [':dict_id' => null]
        );
    }
}
