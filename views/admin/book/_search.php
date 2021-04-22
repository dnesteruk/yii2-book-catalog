<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\entities\BookEntity;

/**
 * @var yii\web\View $this
 * @var app\models\search\BookSearch $model
 * @var yii\widgets\ActiveForm $form
 */

?>

<div class="book-entity-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'picture') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'author_id')
            ->dropDownList(BookEntity::getAllAuthors(), [
                'class' => 'form-control',
                'prompt' => 'Select authors',
            ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
