<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\entities\BookEntity;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var app\models\search\BookSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('app', 'Books');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="book-entity-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::button('Create book', [
            'value' => Url::to(['/admin/book/create']),
            'title' => 'Create Book',
            'class' => 'showModalButton btn btn-success',
        ]) ?>
    </p>

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            /*'id',*/
            'title',
            'description',
            [
                'attribute' => 'picture',
                'filter' => false,
                'format' => 'raw',
                'value' => static function ($model) {
                    if (!$model->picture) {
                        return '<img src="' . DIRECTORY_SEPARATOR . Yii::getAlias('@storage') . DIRECTORY_SEPARATOR . BookEntity::DEFAULT_PICTURE . '" width="80px" height="auto">';
                    }
                    return '<img src="'  . DIRECTORY_SEPARATOR . Yii::getAlias('@storage') . DIRECTORY_SEPARATOR . $model->picture . '" width="80px" height="auto">';
                },
                'headerOptions' => ['width' => '100'],
            ],
            [
                'attribute' => 'date',
                'filter' => false,
                'format'=>'date',
                'headerOptions' => ['width' => '100'],
            ],
            [
                'attribute' => 'author_id',
                'format' => 'html',
                'value' => static function ($model) {
                    $result = '';
                    foreach ($model->authors as $author) {
                        $result .= '&bull; ' . $author->last_name . ' ' . $author->first_name . ' ' . $author->middle_name . '<br>';
                    }
                    return $result;
                },
                'filter' => Html::activedropDownList(
                    $searchModel,
                    'author_id',
                    BookEntity::getAllAuthors(),
                    ['class' => 'form-control', 'prompt' => 'Select authors'],
                ),
                'options' => ['width' => '250'],
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=> Yii::t('app', 'Actions'),
                'headerOptions' => ['width' => '70'],
                'template'=>'{view} {update} {delete} ',
                'buttons'=>[
                    'update' => static function ($url, $model, $key) {
                        return Html::button("<span class='glyphicon glyphicon-pencil'></span>",[
                            'value'=>Yii::$app->urlManager->createUrl('/admin/book/update?id='.$key),
                            'class'=>'showModalButton btn btn-link',
                            'style' => 'padding: 0;',
                            'data-toggle'=>'tooltip',
                            'data-placement'=>'bottom',
                            'title'=>'Update',
                        ]);
                    },
                ],
            ],
        ],
    ]) ?>

</div>