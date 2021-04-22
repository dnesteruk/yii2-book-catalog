<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%author}}`.
 */
class m210410_094632_create_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%author}}', [
            'id' => $this->primaryKey(),
            'last_name' => $this->string(50)->notNull(),
            'first_name' => $this->string(50)->notNull(),
            'middle_name' => $this->string(50)->null(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%author}}');
    }
}
