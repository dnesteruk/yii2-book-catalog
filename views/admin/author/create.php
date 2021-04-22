<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\entities\AuthorEntity $model
 */

$this->title = Yii::t('app', 'Create Author');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Author'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="author-entity-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
