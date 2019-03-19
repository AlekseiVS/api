<?php

use yii\db\Migration;

/**
 * Class m190315_103102_links
 */
class m190315_103102_links extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('link', [
            'id' => $this->primaryKey(),
            'original_name' => $this->string()->notNull(),
            'new_name' => $this->string()->notNull(),
            'status' => $this->integer()->defaultValue(1),
            'date_create' => $this->date(),
            'date_end' => $this->date(),
        ]);


        $this->createTable('data_transition', [
            'id' => $this->primaryKey(),
            'link_id' => $this->integer()->notNull(),
            'date_transition' => $this->dateTime()->defaultValue( date("Y-m-d H:i:s", time()) ),
            'referer' => $this->string()->notNull(),
            'ip_address' => $this->string()->notNull(),
            'browser' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('link');
        $this->dropTable('data_transition');
    }

}
