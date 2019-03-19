<?php

use yii\db\Migration;

/**
 * Class m190318_103017_add_column_days
 */
class m190318_103017_add_column_days extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('link', 'days', $this->integer()->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('link', 'days');
    }


}
