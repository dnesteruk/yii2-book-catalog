<?php

namespace app\controllers;

use app\models\entities\BookEntity;
use yii\data\Pagination;

class HomeController extends AppController
{
    public function actionIndex(): string
    {
        $query = BookEntity::find()
            ->joinWith(['authors'], true)
            ->where(['>', 'book_author.id', '0'])
            ->groupBy(['id',]);

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 15]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
        ]);
    }
}
