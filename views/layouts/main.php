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
        :root {
            --color-dark: #1a1a1a;
            --color-gray-900: #2d2d2d;
            --color-gray-700: #4a4a4a;
            --color-gray-500: #6b6b6b;
            --color-gray-300: #d4d4d4;
            --color-gray-100: #f5f5f5;
            --color-border: #e5e5e5;
            --color-white: #ffffff;
            
            /* Color de acento verde */
            --color-accent: #28a745;
            --color-accent-dark: #218838;
            --color-accent-darker: #1e7e34;
            --color-accent-light: #34ce57;
            --color-accent-lighter: #5dd879;
            --color-accent-pale: #d4edda;
            
            --transition-base: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        body, h1, h2, h3, h4, h5, h6, .navbar-brand, .btn {
            font-family: 'Montserrat', sans-serif !important;
        }

        /* ============ HEADER PRINCIPAL ============ */
        #header {
            background: var(--color-white);
            transition: var(--transition-base);
            border-bottom: 1px solid var(--color-border);
        }

        #header.scrolled {
            box-shadow: var(--shadow-md);
        }

        /* ============ LOGO ============ */
        .header-logo {
            transition: opacity 0.2s ease;
        }

        .header-logo:hover {
            opacity: 0.8;
        }

        /* ============ BUSCADOR ============ */
        .search-container .form-control {
            border: 1px solid var(--color-border);
            padding: 0.625rem 1.25rem;
            font-size: 0.9rem;
            transition: var(--transition-base);
            background: var(--color-gray-100);
        }

        .search-container .form-control:focus {
            outline: none;
            border-color: var(--color-gray-700);
            background: var(--color-white);
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.05);
        }

        .search-container .form-control::placeholder {
            color: var(--color-gray-500);
        }

        .search-container .btn-search {
            border: 1px solid var(--color-border);
            border-left: none;
            background: var(--color-gray-100);
            color: var(--color-gray-700);
            padding: 0.625rem 1.25rem;
            transition: var(--transition-base);
        }

        .search-container .btn-search:hover {
            background: var(--color-gray-900);
            color: var(--color-white);
            border-color: var(--color-gray-900);
        }

        /* ============ ICONOS DE ACCIÓN ============ */
        .header-icon-btn {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: var(--transition-base);
            color: var(--color-gray-700);
            position: relative;
            text-decoration: none;
        }

        .header-icon-btn:hover {
            background-color: var(--color-gray-100);
            color: var(--color-dark);
        }

        .badge-notif {
            position: absolute;
            top: -4px;
            right: -4px;
            font-size: 0.625rem;
            padding: 0.25em 0.5em;
            background: var(--color-accent);
        }

        /* ============ DROPDOWN DE USUARIO ============ */
        .user-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border: 1px solid var(--color-border);
            border-radius: 8px;
            background: var(--color-white);
            transition: var(--transition-base);
            text-decoration: none;
            color: var(--color-dark);
        }

        .user-btn:hover {
            background: var(--color-gray-100);
            border-color: var(--color-gray-700);
            color: var(--color-dark);
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            background: var(--color-accent);
            color: var(--color-white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .dropdown-menu {
            position: absolute !important;
            top: 100% !important;
            left: 0 !important;
            z-index: 1000;
            border: 1px solid var(--color-border);
            border-radius: 8px;
            box-shadow: var(--shadow-lg);
            margin-top: 0 !important;
            min-width: 200px;
        }

        .dropdown-item {
            padding: 0.625rem 1rem;
            transition: var(--transition-base);
            color: var(--color-gray-700);
        }

        .dropdown-item:hover {
            background: var(--color-gray-100);
            color: var(--color-dark);
        }

        /* ============ NAVEGACIÓN DESKTOP ============ */
        .nav-link-custom {
            position: relative;
            font-weight: 500;
            color: var(--color-gray-700) !important;
            transition: var(--transition-base);
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
            text-decoration: none;
        }

        .nav-link-custom::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            background: var(--color-accent);
            transition: width 0.3s ease;
        }

        .nav-link-custom:hover {
            color: var(--color-accent) !important;
        }

        .nav-link-custom:hover::after {
            width: 80%;
        }

        .dropdown,
        .dropdown-hover {
            position: relative;
        }

        .dropdown-hover:hover > .dropdown-menu {
            display: block;
        }

        /* ============ BOTÓN LOGIN ============ */
        .btn-login {
            padding: 0.5rem 1.5rem;
            background: var(--color-accent);
            color: var(--color-white);
            border: 2px solid var(--color-accent);
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.875rem;
            transition: var(--transition-base);
            text-decoration: none;
        }

        .btn-login:hover {
            background: var(--color-accent-dark);
            border-color: var(--color-accent-dark);
            color: var(--color-white);
        }

        /* ============ MENÚ MÓVIL ============ */
        .mobile-toggle {
            border: none;
            background: none;
            padding: 0.5rem;
            color: var(--color-dark);
            transition: var(--transition-base);
        }

        .mobile-toggle:hover {
            background: var(--color-gray-100);
            border-radius: 8px;
        }

        .offcanvas-header {
            background: var(--color-accent);
            color: var(--color-white);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .offcanvas-body {
            padding: 0;
        }

        .mobile-user-section {
            padding: 1.5rem;
            background: var(--color-gray-100);
            border-bottom: 1px solid var(--color-border);
        }

        .mobile-nav-link {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: var(--color-gray-700);
            text-decoration: none;
            transition: var(--transition-base);
            border-bottom: 1px solid var(--color-gray-100);
        }

        .mobile-nav-link:hover {
            background: var(--color-gray-100);
            color: var(--color-dark);
        }

        .mobile-nav-link i {
            font-size: 1.25rem;
            margin-right: 1rem;
            color: var(--color-gray-500);
        }

        .mobile-section-header {
            padding: 0.75rem 1.5rem;
            background: var(--color-gray-100);
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--color-gray-500);
            letter-spacing: 0.5px;
        }

        .mobile-categories {
            background: var(--color-gray-100);
            padding: 0.5rem 0;
        }

        .mobile-categories a {
            display: block;
            padding: 0.75rem 3rem;
            color: var(--color-gray-700);
            text-decoration: none;
            transition: var(--transition-base);
        }

        .mobile-categories a:hover {
            background: var(--color-white);
            color: var(--color-dark);
        }

        /* ============ RESPONSIVE ============ */
        @media (max-width: 767px) {
            .search-container .form-control {
                font-size: 0.875rem;
                padding: 0.5rem 1rem;
            }

            #footer .footer-about, 
            #footer .footer-contact, 
            #footer .footer-links {
                text-align: center;
                margin-bottom: 30px;
            }
            
            #footer .social-links {
                justify-content: center;
            }
        }

        /* ============ ANIMACIONES ============ */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-4px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-menu {
            animation: fadeIn 0.2s ease;
        }
    </style>
    
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header" class="sticky-top">
    <!-- BARRA SUPERIOR -->
    <div class="py-3 border-bottom">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between gap-3">
                
                <!-- Logo -->
                <a class="header-logo" href="<?= Yii::$app->homeUrl ?>">
                    <?= Html::img('@web/uploads/ico_01-10-2025.png', [
                        'alt' => Yii::$app->name, 
                        'style' => 'height: 40px; width: auto;'
                    ]) ?>
                </a>

                <!-- Buscador Desktop -->
                <div class="flex-grow-1 search-container d-none d-md-block mx-4">
                    <form action="<?= \yii\helpers\Url::to(['site/index']) ?>" method="get">
                        <div class="input-group">
                            <input type="text" name="buscar" class="form-control" placeholder="Buscar productos..." aria-label="Buscar">
                            <button class="btn btn-search" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Acciones Desktop -->
                <div class="d-flex align-items-center gap-2">
                    <?php if (!Yii::$app->user->isGuest): ?>
                        <!-- Notificaciones -->
                        <a href="#" class="header-icon-btn d-none d-md-flex" title="Notificaciones">
                            <i class="bi bi-bell"></i>
                            <span class="badge badge-notif rounded-pill" id="desktop-notif-badge" style="display: none;">0</span>
                        </a>

                        <!-- Favoritos -->
                        <a href="<?= \yii\helpers\Url::to(['/favoritos/index']) ?>" class="header-icon-btn d-none d-md-flex" title="Favoritos">
                            <i class="bi bi-heart"></i>
                        </a>
                    <?php endif; ?>

                    <!-- Usuario / Login -->
                    <div class="dropdown d-none d-md-block">
                        <?php if (Yii::$app->user->isGuest): ?>
                            <a href="<?= \yii\helpers\Url::to(['/site/login']) ?>" class="btn-login">
                                <i class="bi bi-person me-1"></i>
                                Iniciar Sesión
                            </a>
                        <?php else: ?>
                            <?php $user = Yii::$app->user->identity; ?>
                            <a href="#" class="user-btn dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-avatar">
                                    <?= strtoupper(substr($user->email, 0, 1)) ?>
                                </div>
                                <span class="small fw-semibold d-none d-lg-inline text-truncate" style="max-width: 120px;">
                                    <?= Html::encode(explode('@', $user->email)[0]) ?>
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li class="px-3 py-2 border-bottom">
                                    <div class="small text-muted mb-1">Conectado como</div>
                                    <div class="fw-semibold small"><?= Html::encode($user->email) ?></div>
                                </li>
                                <li><a class="dropdown-item" href="<?= \yii\helpers\Url::to(['/compras/index']) ?>"><i class="bi bi-bag me-2"></i>Mis compras</a></li>
                                <li><a class="dropdown-item" href="<?= \yii\helpers\Url::to(['/favoritos/index']) ?>"><i class="bi bi-heart me-2"></i>Favoritos</a></li>
                                <li><a class="dropdown-item" href="<?= \yii\helpers\Url::to(['/user/profile']) ?>"><i class="bi bi-person-gear me-2"></i>Mi perfil</a></li>
                                <li><hr class="dropdown-divider my-1"></li>
                                <li>
                                    <?= Html::beginForm(['/site/logout'], 'post', ['class' => 'px-3 py-1']) ?>
                                        <button type="submit" class="dropdown-item text-danger p-0">
                                            <i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión
                                        </button>
                                    <?= Html::endForm() ?>
                                </li>
                            </ul>
                        <?php endif; ?>
                    </div>

                    <!-- Botón Menú Móvil -->
                    <button class="mobile-toggle d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileOffcanvas">
                        <i class="bi bi-list fs-3"></i>
                    </button>
                </div>
            </div>
            
            <!-- Buscador Móvil -->
            <div class="d-md-none mt-3">
                <form action="<?= \yii\helpers\Url::to(['site/index']) ?>" method="get">
                    <div class="input-group search-container">
                        <input type="text" name="buscar" class="form-control" placeholder="Buscar productos..." aria-label="Buscar">
                        <button class="btn btn-search" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- NAVEGACIÓN DESKTOP -->
    <nav class="d-none d-md-block border-bottom">
        <div class="container">
            <ul class="navbar-nav flex-row justify-content-center gap-1 mb-0 py-2">
                <li class="nav-item">
                    <a class="nav-link-custom" href="<?= \yii\helpers\Url::to(['/site/index']) ?>">Inicio</a>
                </li>
                <li class="nav-item dropdown dropdown-hover">
                    <a class="nav-link-custom dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Categorías
                    </a>
                    <ul class="dropdown-menu" id="desktop-categories-list">
                        <li><span class="dropdown-item text-muted small">Cargando...</span></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link-custom" href="#">Ofertas</a>
                </li>
                <?php if (!Yii::$app->user->isGuest): ?>
                <li class="nav-item">
                    <a class="nav-link-custom" href="<?= \yii\helpers\Url::to(['/compras/index']) ?>">Mis Compras</a>
                </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link-custom" href="#">Ayuda</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- MENÚ MÓVIL -->
    <div class="offcanvas offcanvas-start" style="max-width: 320px;" tabindex="-1" id="mobileOffcanvas">
        <div class="offcanvas-header">
            <a href="<?= Yii::$app->homeUrl ?>">
                <?= Html::img('@web/uploads/ico_01-10-2025.png', [
                    'alt' => Yii::$app->name, 
                    'style' => 'height: 32px; width: auto;'
                ]) ?>
            </a>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">
            <!-- Sección de Usuario -->
            <?php if (!Yii::$app->user->isGuest): ?>
                <?php $user = Yii::$app->user->identity; ?>
                <div class="mobile-user-section text-center">
                    <div class="user-avatar mx-auto mb-2" style="width: 56px; height: 56px; font-size: 1.5rem;">
                        <?= strtoupper(substr($user->email, 0, 1)) ?>
                    </div>
                    <div class="fw-semibold small mb-1"><?= Html::encode(explode('@', $user->email)[0]) ?></div>
                    <div class="text-muted" style="font-size: 0.75rem;"><?= Html::encode($user->email) ?></div>
                </div>
            <?php else: ?>
                <div class="mobile-user-section text-center">
                    <p class="text-muted small mb-3">Inicia sesión para disfrutar de tu experiencia personalizada</p>
                    <a href="<?= \yii\helpers\Url::to(['/site/login']) ?>" class="btn-login w-100">
                        <i class="bi bi-person me-1"></i>
                        Iniciar Sesión
                    </a>
                </div>
            <?php endif; ?>

            <!-- Enlaces Principales -->
            <nav>
                <a href="<?= \yii\helpers\Url::to(['/site/index']) ?>" class="mobile-nav-link">
                    <i class="bi bi-house"></i>
                    Inicio
                </a>
                
                <a class="mobile-nav-link" data-bs-toggle="collapse" href="#mobileCategoriesCollapse">
                    <i class="bi bi-grid"></i>
                    <span class="flex-grow-1">Categorías</span>
                    <i class="bi bi-chevron-down small"></i>
                </a>
                <div class="collapse mobile-categories" id="mobileCategoriesCollapse">
                    <div id="mobile-categories-list">
                        <a href="#" class="text-muted small">Cargando...</a>
                    </div>
                </div>

                <a href="#" class="mobile-nav-link">
                    <i class="bi bi-percent"></i>
                    Ofertas
                </a>

                <?php if (!Yii::$app->user->isGuest): ?>
                    <div class="mobile-section-header">Mi Cuenta</div>
                    
                    <a href="<?= \yii\helpers\Url::to(['/compras/index']) ?>" class="mobile-nav-link">
                        <i class="bi bi-bag"></i>
                        Mis compras
                    </a>

                    <a href="<?= \yii\helpers\Url::to(['/favoritos/index']) ?>" class="mobile-nav-link">
                        <i class="bi bi-heart"></i>
                        Favoritos
                    </a>

                    <a href="#" class="mobile-nav-link">
                        <i class="bi bi-bell"></i>
                        <span class="flex-grow-1">Notificaciones</span>
                        <span class="badge badge-notif rounded-pill" id="mobile-notif-count" style="display: none;">0</span>
                    </a>

                    <a href="<?= \yii\helpers\Url::to(['/user/profile']) ?>" class="mobile-nav-link">
                        <i class="bi bi-person-gear"></i>
                        Mi perfil
                    </a>
                <?php endif; ?>

                <div class="mobile-section-header">Más información</div>
                
                <a href="#" class="mobile-nav-link">
                    <i class="bi bi-question-circle"></i>
                    Ayuda
                </a>

                <a href="#" class="mobile-nav-link">
                    <i class="bi bi-info-circle"></i>
                    Sobre nosotros
                </a>
            </nav>

            <!-- Botón Cerrar Sesión -->
            <?php if (!Yii::$app->user->isGuest): ?>
                <div class="p-3 border-top mt-3">
                    <?= Html::beginForm(['/site/logout'], 'post') ?>
                        <button type="submit" class="btn btn-outline-dark w-100" style="border-radius: 8px; font-weight: 600;">
                            <i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión
                        </button>
                    <?= Html::endForm() ?>
                </div>
            <?php endif; ?>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // ============ SCROLL EFFECT ============
            const header = document.getElementById('header');
            
            const handleScroll = () => {
                if (window.scrollY > 20) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            };

            window.addEventListener('scroll', handleScroll);

            // ============ NOTIFICACIONES ============
            window.actualizarNotificaciones = (count) => {
                const badges = document.querySelectorAll('#desktop-notif-badge, #mobile-notif-count');
                badges.forEach(badge => {
                    if (count > 0) {
                        badge.textContent = count;
                        badge.style.display = 'inline-block';
                    } else {
                        badge.style.display = 'none';
                    }
                });
            };

            // ============ CARGAR CATEGORÍAS ============
            const loadCategories = async () => {
                const API_URL = '/inventario-app/web/index.php?r=api/categorias';
                const desktopList = document.getElementById('desktop-categories-list');
                const mobileList = document.getElementById('mobile-categories-list');

                try {
                    const response = await fetch(API_URL);
                    
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const result = await response.json();

                    if (result.success && Array.isArray(result.data) && result.data.length > 0) {
                        // Desktop
                        if (desktopList) {
                            desktopList.innerHTML = result.data.map(cat => `
                                <li>
                                    <a class="dropdown-item" href="<?= \yii\helpers\Url::to(['/site/index']) ?>?categoria=${cat.id}">
                                        ${cat.titulo}
                                    </a>
                                </li>
                            `).join('');
                        }

                        // Mobile  
                        if (mobileList) {
                            mobileList.innerHTML = result.data.map(cat => `
                                <a href="<?= \yii\helpers\Url::to(['/site/index']) ?>?categoria=${cat.id}">
                                    ${cat.titulo}
                                </a>
                            `).join('');
                        }
                    } else {
                        throw new Error('No se encontraron categorías');
                    }
                } catch (error) {
                    console.error('Error al cargar categorías:', error);
                    
                    if (desktopList) {
                        desktopList.innerHTML = '<li><span class="dropdown-item text-danger small">Error al cargar</span></li>';
                    }
                    
                    if (mobileList) {
                        mobileList.innerHTML = '<a href="#" class="text-danger small">Error al cargar</a>';
                    }
                }
            };

            // Iniciar carga de categorías
            loadCategories();
        });
    </script>
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
