<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\entities\BookEntity;
use kartik\date\DatePicker;
use kartik\file\FileInput;

/**
 * @var yii\web\View $this
 * @var app\models\entities\BookEntity $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="book-entity-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => 'create-product-form'
        ]]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => '3']) ?>

    <?= $form->field($model, 'file')->widget(FileInput::class, [
        'options' => ['accept' => 'image/*'],
        'language' => 'ru',
        'pluginOptions' => [
            'initialPreview' => $model->picture
                ? [
                    Html::img(DIRECTORY_SEPARATOR . Yii::getAlias('@storage') . DIRECTORY_SEPARATOR . $model->picture,
                        [
                            'class' => 'file-preview-image kv-preview-data',
                            'title' => $model->title,
                            'alt' => $model->title,
                            'style' => 'width: auto; height: auto; max-width: 100%; max-height: 100%; image-orientation: from-image;',
                        ])
                ]
                : [],
            'overwriteInitial' => true,
            'showCaption' => false,
            'showUpload' => false,
            'allowedFileExtensions' => ['jpg', 'jpeg', 'png'],
            'maxFileCount' => 1,
            'showPreview' => true,
            /*'showBrowse' => false,
            'browseOnZoneClick' => true,*/
            'browseClass' => 'btn btn-success',
            'removeClass' => 'btn btn-danger',
            'showClose' => false,
            'layoutTemplates' => [
                'actionDelete' => '',
            ],
        ],
    ]) ?>

    <?= $form->field($model, 'date')->widget(DatePicker::class, [
        'attribute' => 'date',
        'options' => ['placeholder' => 'Select publication date ...'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
        ]
    ]) ?>

    <?= $form->field($model, 'selectedAuthors')
        ->dropDownList(BookEntity::getAllAuthors(), [
            'class' => 'form-control',
            'multiple' => true,
            'options' => Yii::$app->params['selected'],
        ]) ?>

    <?php if(!$model->getIsNewRecord()): ?>
    <?= $form->field($model, 'checkPicture')
        ->hiddenInput()
        ->label(false) ?>
        <script>
            $(document).ready(function () {
                $('#bookentity-file').on('fileclear', function (event) {
                    $("#bookentity-checkpicture").val("clear")
                    console.log("fileclear");
                });
            });
        </script>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton($model->getIsNewRecord() ?
            Yii::t('app', 'Create') :
            Yii::t('app', 'Update'), ['class' => $model->getIsNewRecord() ? 'btn btn-success' :
            'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<style>
    .field-bookentity-file .file-input {
        display: table-cell;
        width: 300px;
    }
</style>
