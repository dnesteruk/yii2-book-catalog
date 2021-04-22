<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\YiiAsset;
use yii\widgets\DetailView;
use app\models\entities\BookEntity;

/**
 * @var yii\web\View $this
 * @var app\models\entities\BookEntity $model
 * @var $authorBook
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Book'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="book-entity-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::button('Update', [
            'value' => Url::to(['/admin/book/update', 'id' => $model->id]),
            'title' => 'Updating Book',
            'class' => 'showModalButton btn btn-primary',
        ]) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description',
            [
                'attribute' => 'picture',
                'format' => 'raw',
                'value' => $model->picture
                    ? '<img src="' . DIRECTORY_SEPARATOR . Yii::getAlias('@storage') . DIRECTORY_SEPARATOR . $model->picture . '" width="50px" height="auto">'
                    : '<img src="' . DIRECTORY_SEPARATOR . Yii::getAlias('@storage') . DIRECTORY_SEPARATOR . BookEntity::DEFAULT_PICTURE . '" width="50px" height="auto">',
            ],
            'date:date',
            [
                'attribute' => 'allAuthors',
                'value' => $authorBook,
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
