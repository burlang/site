<?php

use yii\db\Migration;

class m160821_101110_rename_service_link_page_table extends Migration
{
    /**
     * @var string
     */
    protected $tableName = '{{%page}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->update(
            $this->tableName,
            ['link' => 'services'],
            ['link' => 'translation-service']
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->update(
            $this->tableName,
            ['link' => 'translation-service'],
            ['link' => 'services']
        );
    }
}
