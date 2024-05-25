<?php

use yii\db\Migration;

class m160508_062836_rename_tables_rutranslations_burtranslations extends Migration
{
    /**
     * @var string
     */
    protected $tableName1 = '{{%rutranslations}}';

    /**
     * @var string
     */
    protected $newTableName1 = '{{buryat_translation}}';

    /**
     * @var string
     */
    protected $tableName2 = '{{burtranslations}}';

    /**
     * @var string
     */
    protected $newTableName2 = '{{russian_translation}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->renameTable($this->tableName1, $this->newTableName1);
        $this->renameTable($this->tableName2, $this->newTableName2);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->renameTable($this->newTableName1, $this->tableName1);
        $this->renameTable($this->newTableName2, $this->tableName2);
    }
}
