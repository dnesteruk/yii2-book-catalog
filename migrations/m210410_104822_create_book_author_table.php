<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book_author}}`.
 */
class m210410_104822_create_book_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book_author}}', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-book_author-book_id-book-id',
            '{{%book_author}}',
            'book_id',
            '{{%book}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-book_author-author_id-author-id',
            '{{%book_author}}',
            'author_id',
            '{{%author}}',
            'id',
            'RESTRICT',
            'NO ACTION'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-book_author-book_id-book-id', '{{%book_author}}');
        $this->dropForeignKey('fk-book_author-author_id-author-id', '{{%book_author}}');
        $this->dropTable('{{%book_author}}');
    }
}
