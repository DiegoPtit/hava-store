<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar navbar-light bg-white sticky-top shadow-sm'],
        'innerContainerOptions' => ['class' => 'container-fluid justify-content-center'],
        'brandOptions' => ['class' => 'm-0 fw-bold'],
        'togglerOptions' => ['class' => 'd-none'],
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0 mb-5 pb-5" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="fixed-bottom bg-white border-top shadow-lg">
    <div class="container-fluid">
        <div class="row text-center py-3">
            <div class="col">
                <a href="<?= \yii\helpers\Url::to(['/site/index']) ?>" class="text-dark text-decoration-none d-flex flex-column align-items-center">
                    <i class="bi bi-house fs-4"></i>
                </a>
            </div>
            <div class="col">
                <a href="<?= \yii\helpers\Url::to(['/cart/index']) ?>" class="text-dark text-decoration-none d-flex flex-column align-items-center">
                    <i class="bi bi-cart fs-4"></i>
                </a>
            </div>
            <div class="col">
                <?php if (Yii::$app->user->isGuest): ?>
                    <a href="<?= \yii\helpers\Url::to(['/site/login']) ?>" class="text-dark text-decoration-none d-flex flex-column align-items-center">
                        <i class="bi bi-box-arrow-in-right fs-4"></i>
                    </a>
                <?php else: ?>
                    <a href="<?= \yii\helpers\Url::to(['/site/logout']) ?>" data-method="post" class="text-dark text-decoration-none d-flex flex-column align-items-center">
                        <i class="bi bi-box-arrow-right fs-4"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
