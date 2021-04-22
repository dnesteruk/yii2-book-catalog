<?php

/**
 * @var yii\web\View $this
 * @var app\models\entities\BookEntity $models
 * @var yii\data\Pagination $pages
 */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\models\entities\BookEntity;

$this->title = 'Books';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="body-content">
        <div class="row row-flex">
            <?php
            foreach ($models as $model): ?>
                <div class="col-sm-6 col-md-4 wrap-card">
                    <div class="card">
                        <div class="thumbnail">
                            <?php if ($model->picture): ?>
                                <img src="<?= DIRECTORY_SEPARATOR . Yii::getAlias('@storage') . DIRECTORY_SEPARATOR . $model->picture ?>" alt="<?= $model->title ?>">
                            <?php else: ?>
                                <img src="<?= DIRECTORY_SEPARATOR . Yii::getAlias('@storage') . DIRECTORY_SEPARATOR . BookEntity::DEFAULT_PICTURE ?>" alt="<?= $model->title ?>">
                            <?php endif; ?>
                            <div class="caption">
                                <h3><?= $model->title ?></h3>
                                <?php
                                $authors = [];
                                foreach ($model->authors as $author) {
                                    if($author['middle_name']) {
                                        $authors[] = "{$author['last_name']} {$author['first_name']} {$author['middle_name']}";
                                    } else {
                                        $authors[] = "{$author['last_name']} {$author['first_name']}";
                                    }
                                } ?>
                                <p>
                                    <span><?= Yii::t('app', 'Author: '), implode(', ', $authors) ?></span><br>
                                    <?php if ($model->date): ?>
                                        <span><?= Yii::t('app', 'Date: '), $model->date ?></span>
                                    <?php endif; ?>
                                </p>
                                <?php if ($model->description): ?>
                                    <div>
                                        <a role="button" data-toggle="collapse"
                                           href="<?= '#collapseExample' . $model->id ?>"
                                           aria-expanded="false" aria-controls="<?= 'collapseExample' . $model->id ?>">
                                            <?= Yii::t('app', 'Read description') ?>
                                        </a>
                                        <div class="collapse" id="<?= 'collapseExample' . $model->id ?>">
                                            <?= $model->description ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="wrap-pagination">
            <?php
            // display pagination
            echo LinkPager::widget([
                'pagination' => $pages,
            ]);
            ?>
        </div>

    </div>
</div>

<style>
    .row-flex {
        display: flex;
        justify-content: center;
        flex-flow: row wrap;
    }

    .wrap-card {
        margin-bottom: 30px;
    }

    .card {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 4px;
        height: 100%;
    }

    .thumbnail {
        padding: 0;
        border: 0;
        border-radius: 0;
    }

    .wrap-pagination {
        text-align: center;
    }
</style>
