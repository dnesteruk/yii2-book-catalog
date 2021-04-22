<?php

/**
 * @var \yii\web\View $this
 * @var string $content
 */

use app\widgets\Alert;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            !Yii::$app->user->isGuest ? [
                'label' => 'Admin panel',
                'items' => [
                    ['label' => 'Books', 'url' => ['/admin/book']],
                    ['label' => 'Authors', 'url' => ['/admin/author']],
                ],
            ] : '',
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Book catalog <?= date('Y') ?></p>

        <p class="pull-right">All rights reserved.</p>
    </div>
</footer>

<?php
Modal::begin([
    'headerOptions' => ['id' => 'modal-header'],
    'id' => 'modal',
    'size' => 'modal-md',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => false]
]);
echo "<div id='modalContent'></div>";
Modal::end();
?>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>

