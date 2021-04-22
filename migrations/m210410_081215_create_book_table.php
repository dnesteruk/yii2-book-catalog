<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 */
class m210410_081215_create_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(200)->notNull(),
            'description' => $this->string(500)->null(),
            'picture' => $this->string(255)->null(),
            'date' => $this->date()->null(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%book}}');
    }
}
