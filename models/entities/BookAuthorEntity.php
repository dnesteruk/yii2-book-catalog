<?php

namespace app\models\entities;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "book_author".
 *
 * @property int $book_id
 * @property int $author_id
 *
 * @property AuthorEntity $author
 * @property BookEntity $book
 */
class BookAuthorEntity extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'book_author';
    }

    public function rules(): array
    {
        return [
            [['book_id', 'author_id'], 'required'],
            [['book_id', 'author_id'], 'integer'],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => AuthorEntity::class, 'targetAttribute' => ['author_id' => 'id']],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => BookEntity::class, 'targetAttribute' => ['book_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'book_id' => Yii::t('app', 'Book ID'),
            'author_id' => Yii::t('app', 'Author ID'),
        ];
    }

    public function getAuthor(): ActiveQuery
    {
        return $this->hasOne(AuthorEntity::class, ['id' => 'author_id']);
    }

    public function getBook(): ActiveQuery
    {
        return $this->hasOne(BookEntity::class, ['id' => 'book_id']);
    }
}
