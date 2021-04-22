<?php

namespace app\models\entities;

use Yii;
use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string $last_name
 * @property string $first_name
 * @property string|null $middle_name
 * @property string $created_at
 * @property string $updated_at
 *
 * @property BookAuthorEntity[] $bookAuthors
 * @property BookEntity[] $books
 */
class AuthorEntity extends ActiveRecord
{
    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public static function tableName(): string
    {
        return 'author';
    }

    public function rules(): array
    {
        return [
            [['last_name', 'first_name'], 'required'],
            [['last_name', 'first_name', 'middle_name'], 'trim'],
            [['created_at', 'updated_at'], 'safe'],
            [['last_name'], 'string', 'min' => 3, 'max' => 50],
            [['last_name', 'first_name', 'middle_name'], 'string', 'min' => 2, 'max' => 50],
            [['last_name', 'first_name'], 'unique', 'targetAttribute' => ['last_name', 'first_name']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'last_name' => Yii::t('app', 'Last Name'),
            'first_name' => Yii::t('app', 'First Name'),
            'middle_name' => Yii::t('app', 'Middle Name'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /*public function getBookAuthors(): ActiveQuery
    {
        return $this->hasMany(BookAuthorEntity::class, ['author_id' => 'id']);
    }*/

    /**
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getBooks(): ActiveQuery
    {
        try {
            return $this->hasMany(BookEntity::class, ['id' => 'book_id'])->viaTable('book_author', ['author_id' => 'id']);
        } catch (InvalidConfigException $e) {
            throw new InvalidConfigException($e->getMessage());
        }
    }
}
