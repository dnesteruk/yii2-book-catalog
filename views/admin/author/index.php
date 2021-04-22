<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var app\models\search\AuthorSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('app', 'Authors');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="author-entity-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::button('Create author', [
            'value' => Url::to(['/admin/author/create']),
            'title' => 'Create Author',
            'class' => 'showModalButton btn btn-success',
        ]) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'last_name',
            'first_name',
            [
                'attribute' => 'middle_name',
                'filter' => false,
                'format' => 'text',
            ],
            [
                'attribute' => 'created_at',
                'filter' => false,
                'format'=>'datetime',
                'headerOptions' => ['width' => '200'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=> Yii::t('app', 'Actions'),
                'headerOptions' => ['width' => '70'],
                'template'=>'{view} {update} {delete} ',
                'buttons'=>[
                    'update' => static function ($url, $model, $key) {
                        return Html::button("<span class='glyphicon glyphicon-pencil'></span>",[
                            'value'=>Yii::$app->urlManager->createUrl('/admin/author/update?id='.$key),
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
