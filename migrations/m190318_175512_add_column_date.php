<?php

use yii\db\Migration;

/**
 * Class m190318_175512_add_column_date
 */
class m190318_175512_add_column_date extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('data_transition', 'date', $this->date());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('data_transition', 'date');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190318_175512_add_column_date cannot be reverted.\n";

        return false;
    }
    */
}
