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
    
    <!-- Google Fonts: Montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body, h1, h2, h3, h4, h5, h6, .navbar-brand, .btn {
            font-family: 'Montserrat', sans-serif !important;
        }

        /* Responsive adjustments */
        @media (max-width: 767px) {
            #navbarCollapse.show {
                border-top: 1px solid #eee;
                box-shadow: 0 10px 15px rgba(0,0,0,0.1);
            }
            
            /* Footer mobile styling */
            #footer .footer-about, 
            #footer .footer-contact, 
            #footer .footer-links {
                text-align: center;
                margin-bottom: 30px; /* Add spacing between sections */
            }
            #footer .footer-about a {
                justify-content: center; /* Center brand name */
            }
            #footer .social-links {
                justify-content: center;
            }
            /* Remove margin from last element handled by row gap, but just in case */
            #footer .footer-contact {
                margin-bottom: 10px;
            }
            #footer .credits {
                text-align: center;
                margin-top: 15px;
            }
            #footer .footer-links ul {
                display: inline-block; /* Helps with centering lists if needed */
                text-align: center;
                padding: 0;
            }
        }
    </style>
    
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header" class="sticky-top" style="z-index: 1020;">
    <div class="bg-white shadow-sm position-relative">
        <!-- ROW 1: Logo + Search + Mobile Toggler -->
        <div class="container py-2">
            <div class="d-flex align-items-center justify-content-between">
                
                <!-- Logo -->
                <a class="navbar-brand ms-3 me-4" href="<?= Yii::$app->homeUrl ?>">
                    <?= Html::img('@web/uploads/ico_01-10-2025.png', [
                        'alt' => Yii::$app->name, 
                        'style' => 'height: 45px; width: auto;'
                    ]) ?>
                </a>

                <!-- Search Bar -->
                <div class="flex-grow-1 mx-2">
                    <form class="w-100 mx-auto" style="max-width: 600px;" action="<?= \yii\helpers\Url::to(['site/index']) ?>" method="get">
                        <div class="input-group">
                            <input type="text" name="buscar" class="form-control border-end-0" placeholder="Buscar productos..." aria-label="Buscar">
                            <button class="btn btn-outline-secondary border-start-0" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Mobile Toggler -->
                 <button class="navbar-toggler d-md-none border-0 ms-2 me-2" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu" aria-controls="mobileMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="bi bi-list fs-1 text-dark"></i>
                </button>
            </div>
        </div>

        <!-- ROW 2: Desktop Navigation Menu -->
        <div class="border-top d-none d-md-block">
            <div class="container py-2">
                <div class="d-flex align-items-center justify-content-between ms-3 me-3">
                    
                    <!-- Left: Categorías -->
                    <a href="#" class="text-dark text-decoration-none fw-bold d-flex align-items-center me-4">
                        <i class="bi bi-list me-2 fs-5"></i> Categorías
                    </a>
                    
                    <!-- Right: Menu Groups -->
                    <div class="d-flex align-items-center gap-4">
                        <a href="<?= \yii\helpers\Url::to(['/site/index']) ?>" class="text-dark text-decoration-none small fw-bold">Inicio</a>

                        <a href="#" class="text-dark position-relative text-decoration-none notification-icon" title="Notificaciones">
                            <i class="bi bi-bell fs-5"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="desktop-notif-badge" style="display: none;">0</span>
                        </a>

                        <a href="<?= \yii\helpers\Url::to(['/compras/index']) ?>" class="text-dark text-decoration-none small fw-bold">Mis compras</a>

                        <a href="<?= \yii\helpers\Url::to(['/favoritos/index']) ?>" class="text-dark text-decoration-none small fw-bold">Favoritos</a>

                        <!-- User Dropdown -->
                        <div class="dropdown user-dropdown">
                            <?php if (Yii::$app->user->isGuest): ?>
                                <a href="<?= \yii\helpers\Url::to(['/site/login']) ?>" class="d-flex align-items-center text-dark text-decoration-none">
                                    <i class="bi bi-person-circle fs-4 me-1"></i>
                                    <span class="small fw-bold">Iniciar Sesión</span>
                                </a>
                            <?php else: ?>
                                <?php $user = Yii::$app->user->identity; ?>
                                <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle-custom py-1" id="userDropdown">
                                    <i class="bi bi-person-circle fs-4 me-2"></i>
                                    <span class="small fw-bold text-truncate" style="max-width: 150px;"><?= Html::encode($user->email) ?></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="userDropdown">
                                    <li class="px-3 py-2 border-bottom bg-light">
                                        <div class="fw-bold text-dark"><?= Html::encode($user->email) ?></div>
                                    </li>
                                    <li><a class="dropdown-item py-2" href="<?= \yii\helpers\Url::to(['/compras/index']) ?>">Compras</a></li>
                                    <li><a class="dropdown-item py-2" href="#">Preguntas</a></li>
                                    <li><a class="dropdown-item py-2" href="<?= \yii\helpers\Url::to(['/user/profile']) ?>">Mi perfil</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <?= Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex w-100']) ?>
                                            <button type="submit" class="dropdown-item text-danger w-100 text-start">Cerrar Sesión</button>
                                        <?= Html::endForm() ?>
                                    </li>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Collapsible Menu (Absolute inside relative parent) -->
        <div class="collapse d-md-none bg-white w-100 border-top shadow-lg" id="mobileMenu" style="position: absolute; top: 100%; left: 0; right: 0; z-index: 1050; max-height: 80vh; overflow-y: auto;">
            <div class="p-4">
                <?php if (!Yii::$app->user->isGuest): ?>
                    <?php $user = Yii::$app->user->identity; ?>
                    <div class="d-flex align-items-center mb-4 p-3 bg-light rounded shadow-sm">
                        <div class="avatar-circle bg-white border d-flex align-items-center justify-content-center rounded-circle me-3" style="width: 50px; height: 50px;">
                            <i class="bi bi-person fs-3 text-secondary"></i>
                        </div>
                        <div class="overflow-hidden">
                            <div class="fw-bold text-dark text-truncate"><?= Html::encode($user->email) ?></div>
                            <div class="small text-muted">Usuario</div>
                        </div>
                    </div>
                <?php else: ?>
                     <div class="mb-4">
                        <a href="<?= \yii\helpers\Url::to(['/site/login']) ?>" class="btn btn-primary w-100 fw-bold py-2 rounded-pill">Iniciar Sesión</a>
                     </div>
                <?php endif; ?>

                <ul class="nav flex-column mobile-nav-list gap-2">
                    <li class="nav-item border-bottom pb-2"><a class="nav-link text-dark px-2" href="<?= \yii\helpers\Url::to(['/site/index']) ?>"><i class="bi bi-house me-3 fs-5"></i> Inicio</a></li>
                    <li class="nav-item border-bottom pb-2">
                         <a class="nav-link text-dark px-2 d-flex justify-content-between align-items-center" href="#">
                            <span><i class="bi bi-bell me-3 fs-5"></i> Notificaciones</span>
                            <span class="badge bg-danger rounded-pill" id="mobile-notif-count" style="display: none;">0</span>
                        </a>
                    </li>
                    <li class="nav-item border-bottom pb-2"><a class="nav-link text-dark px-2" href="<?= \yii\helpers\Url::to(['/compras/index']) ?>"><i class="bi bi-bag me-3 fs-5"></i> Mis compras</a></li>
                    <li class="nav-item border-bottom pb-2"><a class="nav-link text-dark px-2" href="<?= \yii\helpers\Url::to(['/favoritos/index']) ?>"><i class="bi bi-heart me-3 fs-5"></i> Favoritos</a></li>
                    <li class="nav-item border-bottom pb-2"><a class="nav-link text-dark px-2" href="#"><i class="bi bi-grid me-3 fs-5"></i> Categorías</a></li>
                    <li class="nav-item border-bottom pb-2"><a class="nav-link text-dark px-2" href="<?= \yii\helpers\Url::to(['/user/profile']) ?>"><i class="bi bi-person-gear me-3 fs-5"></i> Mi cuenta</a></li>
                    
                    <?php if (!Yii::$app->user->isGuest): ?>
                        <li class="nav-item mt-3">
                            <?= Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex']) ?>
                                <button type="submit" class="nav-link btn btn-link text-danger w-100 text-start px-2 fw-bold"><i class="bi bi-box-arrow-right me-3 fs-5"></i> Cerrar Sesión</button>
                            <?= Html::endForm() ?>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Notifications Logic
            window.actualizarNotificaciones = function(count) {
                const badges = document.querySelectorAll('#desktop-notif-badge, #mobile-notif-count');
                badges.forEach(badge => {
                    if(count > 0) {
                        badge.innerText = count;
                        badge.style.display = 'inline-block';
                    } else {
                        badge.style.display = 'none';
                    }
                });
            };

            // Enhanced fallback for toggler
            var toggler = document.querySelector('.navbar-toggler');
            var menu = document.querySelector('#mobileMenu');
            if(toggler && menu) {
                toggler.addEventListener('click', function(e) {
                    if (typeof bootstrap !== 'undefined') {
                       // Try using bootstrap instance
                       var bsCollapse = bootstrap.Collapse.getInstance(menu);
                       if(!bsCollapse) {
                           new bootstrap.Collapse(menu, { toggle: true });
                       } else {
                           bsCollapse.toggle();
                       }
                    } else {
                       // Pure JS Fallback if Bootstrap JS not ready or conflict
                       menu.classList.toggle('show');
                    }
                });
            }
        });
    </script>

    <style>
        @media (min-width: 768px) {
            .user-dropdown:hover .dropdown-menu {
                display: block;
                margin-top: 0;
            }
            .user-dropdown .dropdown-menu {
                margin-top: 0;
            }
        }
        .mobile-nav-list .nav-link:active, .mobile-nav-list .nav-link:hover {
            background-color: #f8f9fa;
            border-radius: 8px;
        }
    </style>
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

<footer id="footer" class="mt-auto bg-light border-top">
    <div class="container py-5">
        <div class="row gy-4">
            <!-- Información de la Empresa -->
            <div class="col-lg-4 col-md-6 footer-about">
                <a href="<?= Yii::$app->homeUrl ?>" class="d-flex align-items-center mb-3 text-dark text-decoration-none">
                     <span class="fs-4 fw-bold"><?= Yii::$app->name ?></span>
                </a>
                <p class="text-muted">Tu destino confiable para productos de calidad. Innovación y estilo para tu hogar y vida diaria.</p>
                <div class="social-links d-flex mt-4">
                    <a href="#" class="me-3 text-secondary fs-5"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="me-3 text-secondary fs-5"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="me-3 text-secondary fs-5"><i class="bi bi-tiktok"></i></a>
                    <a href="#" class="text-secondary fs-5"><i class="bi bi-whatsapp"></i></a>
                </div>
            </div>

            <!-- Enlaces Rápidos -->
            <div class="col-lg-4 col-md-6 footer-links">
                <h5 class="fw-bold mb-3">Enlaces Útiles</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="<?= \yii\helpers\Url::to(['site/index']) ?>" class="text-decoration-none text-secondary">Inicio</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Catálogo</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Ofertas</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Contacto</a></li>
                </ul>
            </div>

            <!-- Contacto -->
            <div class="col-lg-4 col-md-12 footer-contact text-md-start">
                <h5 class="fw-bold mb-3">Contáctanos</h5>
                <p class="text-muted">
                    Centro Comercial City Market, Nivel Plaza <br>
                    Caracas, Venezuela <br><br>
                    <strong>Teléfono:</strong> +58 412 1234567<br>
                    <strong>Email:</strong> contacto@havastore.com<br>
                </p>
            </div>
        </div>
    </div>
    
    <!-- Sub-footer: Copyright y Políticas -->
    <div class="bg-white border-top py-3">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <div class="copyright text-muted mb-2 mb-md-0 small">
                    &copy; <?= date('Y') ?> <strong><span><?= Yii::$app->name ?></span></strong>. Todos los derechos reservados.
                </div>
                <div class="credits mobile-center">
                    <a href="#" class="text-decoration-none text-muted small me-3">Política de Privacidad</a>
                    <a href="#" class="text-decoration-none text-muted small">Términos y Condiciones</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
