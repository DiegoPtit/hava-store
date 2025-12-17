<?php

/** @var yii\web\View $this */
/** @var array $productos */
/** @var mixed $precioOficial */
/** @var mixed $precioParalelo */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Hava Store';

$this->registerCss('
/* Shared Carousel Styles */
.carousel-wrapper {
    position: relative;
    width: 100%;
    margin-bottom: 40px;
    padding: 0 10px;
}

.carousel-scroll-area {
    display: flex;
    gap: 15px;
    overflow-x: auto;
    overflow-y: hidden;
    scroll-behavior: smooth;
    -webkit-overflow-scrolling: touch;
    scroll-snap-type: x mandatory;
    padding: 20px 0;
    -ms-overflow-style: none;
    scrollbar-width: none;
}

.carousel-scroll-area::-webkit-scrollbar {
    display: none;
}

.carousel-nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 20;
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    display: none;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    color: #333;
}

.carousel-nav-btn:hover:not(:disabled) {
    background: #007bff;
    border-color: #007bff;
    color: white;
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 6px 16px rgba(0,123,255,0.4);
}

.carousel-nav-btn:disabled {
    opacity: 0.0;
    cursor: default;
    pointer-events: none;
}

.carousel-nav-btn i { font-size: 1.4rem; }
.carousel-prev { left: 10px; }
.carousel-next { right: 10px; }

/* Product Card */
.product-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 380px;
    display: flex;
    flex-direction: column;
    text-decoration: none;
    color: inherit;
    cursor: pointer;
    flex-shrink: 0;
    border: 1px solid #f0f0f0;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
    border-color: transparent;
}

.product-card-header {
    height: 220px;
    position: relative;
    overflow: hidden;
    background: #f8f9fa;
}

.product-card-image {
    width: 100%;
    height: 100%;
    object-fit: contain;
    object-position: center;
    padding: 10px;
    background: white;
}

.product-card-body {
    padding: 15px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.product-card-title {
    font-size: 0.95rem;
    font-weight: 600;
    color: #2c3e50;
    margin: 0 0 10px 0;
    line-height: 1.4;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}

.product-card-footer { margin-top: auto; }

.product-card-price {
    font-size: 1.2rem;
    font-weight: 700;
    color: #28a745;
    display: block;
    margin-bottom: 5px;
}

.product-card-category {
    font-size: 0.7rem;
    color: #adb5bd;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-top: 8px;
    display: block;
}

/* Category Card */
.category-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 380px; /* Match product card height */
    display: flex;
    flex-direction: column;
    text-decoration: none;
    color: inherit;
    cursor: pointer;
    flex-shrink: 0;
    border: 1px solid #f0f0f0;
}

.category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
    border-color: transparent;
}

.category-grid {
    height: 320px;
    display: flex;
    flex-direction: column;
}

.category-grid-top {
    height: 210px; /* ~65% */
    width: 100%;
    margin-bottom: 2px;
    position: relative;
}

.category-grid-bottom {
    flex-grow: 1;
    display: flex;
    gap: 2px;
}

.category-grid-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    background: #f8f9fa;
}

.grid-img-half {
    width: 50%;
}

.category-title-container {
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: white;
    border-top: 1px solid #f0f0f0;
    padding: 0 10px;
}

.category-title {
    font-weight: 700;
    font-size: 1.1rem;
    color: #333;
    text-align: center;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}

/* RESPONSIVE */
@media (max-width: 767px) {
    .carousel-wrapper { padding: 0; }
    .carousel-scroll-area {
        padding: 20px 10%;
        gap: 15px;
    }
    .product-card, .category-card {
        width: 80%;
        min-width: 80%;
        scroll-snap-align: center;
    }
}

@media (min-width: 768px) {
    .carousel-wrapper { padding: 0 60px; }
    .carousel-nav-btn { display: flex; }
    .carousel-prev { left: 0; }
    .carousel-next { right: 0; }
    .product-card, .category-card {
        width: 250px;
        min-width: 250px;
        scroll-snap-align: start;
    }
}

@media (min-width: 1200px) {
    .product-card, .category-card {
        width: 280px;
        min-width: 280px;
    }
}
');

$this->registerJs("
    (function() {
        // Init all carousels
        const carousels = document.querySelectorAll('.carousel-wrapper');
        
        carousels.forEach(wrapper => {
            const scrollContainer = wrapper.querySelector('.carousel-scroll-area');
            const prevBtn = wrapper.querySelector('.carousel-prev');
            const nextBtn = wrapper.querySelector('.carousel-next');
            
            if (!scrollContainer) return;

            const getScrollAmount = () => {
                if (window.innerWidth < 768) {
                    const card = scrollContainer.querySelector('.product-card, .category-card');
                    return card ? card.offsetWidth + 15 : window.innerWidth * 0.8 + 15;
                } else {
                    return 300;
                }
            };

            if (nextBtn) {
                nextBtn.onclick = function() {
                    scrollContainer.scrollBy({ left: getScrollAmount(), behavior: 'smooth' });
                };
            }
                
            if (prevBtn) {
                prevBtn.onclick = function() {
                    scrollContainer.scrollBy({ left: -getScrollAmount(), behavior: 'smooth' });
                };
            }
        });
    })();
", \yii\web\View::POS_END);
?>

<div class="site-index">
    
    <!-- PRODUCTOS SECTION -->
    <section class="mb-5" style="background: transparent;">
        <div class="text-center mb-4">
            <h2 class="text-start">Productos Destacados</h2>
        </div>

        <?php if (empty($productos)): ?>
            <div class="no-products text-center p-5">
                <i class="bi bi-box-seam" style="font-size: 3rem; color: #ccc;"></i>
                <h3 class="mt-3 text-muted">No hay productos destacados</h3>
            </div>
        <?php else: ?>
            <div class="carousel-wrapper">
                <button class="carousel-nav-btn carousel-prev" aria-label="Anterior">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button class="carousel-nav-btn carousel-next" aria-label="Siguiente">
                    <i class="bi bi-chevron-right"></i>
                </button>
                
                <div class="carousel-scroll-area">
                    <?php foreach ($productos as $producto): ?>
                        <?= Html::beginTag('a', [
                            'href' => Url::to(['productos/view', 'id' => $producto->id]),
                            'class' => 'product-card'
                        ]) ?>
                            <div class="product-card-header">
                                <?php
                                $fotoUrl = null;
                                if (!empty($producto->fotos)) {
                                    $fotosArray = json_decode($producto->fotos, true);
                                    if (is_array($fotosArray) && !empty($fotosArray)) {
                                        $fotoUrl = '/inventario-app/web/' . reset($fotosArray);
                                    }
                                }
                                ?>
                                
                                <?php if ($fotoUrl): ?>
                                    <?= Html::img($fotoUrl, [
                                        'alt' => Html::encode($producto->marca . ' ' . $producto->modelo),
                                        'class' => 'product-card-image'
                                    ]) ?>
                                <?php else: ?>
                                    <div class="product-card-image d-flex align-items-center justify-content-center bg-light">
                                        <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="product-card-body">
                                <?php
                                $titulo_partes = array_filter([$producto->marca, $producto->modelo, $producto->color]);
                                $titulo = implode(' - ', $titulo_partes) ?: 'Producto #' . $producto->id;
                                ?>
                                
                                <h3 class="product-card-title" title="<?= Html::encode($titulo) ?>">
                                    <?= Html::encode($titulo) ?>
                                </h3>
                                
                                <div class="product-card-footer">
                                    <div>
                                        <?php 
                                        $precioMostrar = $producto->precio_venta;
                                        $moneda = 'USDT';
                                        
                                        if ($precioParalelo && $precioOficial && $precioOficial->precio_ves > 0) {
                                            $precioVes = $producto->precio_venta * $precioParalelo->precio_ves;
                                            $precioMostrar = $precioVes / $precioOficial->precio_ves;
                                            $moneda = 'BCV';
                                        }
                                        ?>
                                        <span class="product-card-price">
                                            $<?= number_format($precioMostrar, 2) ?> <small class="text-muted" style="font-size: 0.65em;">(<?= $moneda ?>)</small>
                                        </span>
                                    </div>
                                    
                                    <?php if ($producto->categoria): ?>
                                        <span class="product-card-category">
                                            <?= Html::encode($producto->categoria->titulo) ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="product-card-category">Sin categoría</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?= Html::endTag('a') ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </section>

    <!-- CATEGORIAS SECTION -->
    <section style="background: transparent;">

        <?php if (!empty($categorias)): ?>
            <div class="carousel-wrapper">
                <button class="carousel-nav-btn carousel-prev" aria-label="Anterior">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button class="carousel-nav-btn carousel-next" aria-label="Siguiente">
                    <i class="bi bi-chevron-right"></i>
                </button>
                
                <div class="carousel-scroll-area">
                    <?php foreach ($categorias as $cat): ?>
                        <?= Html::beginTag('div', ['class' => 'category-card']) ?>
                            <div class="category-title-container">
                                <span class="category-title" title="<?= Html::encode($cat->titulo) ?>">
                                    <?= Html::encode($cat->titulo) ?>
                                </span>
                            </div>
                            <div class="category-grid">
                                <?php $imgCount = count($cat->imagenes); ?>
                                
                                <?php if ($imgCount == 0): ?>
                                    <!-- 0 Images: Full Placeholder -->
                                    <div class="category-grid-top" style="height: 100%; border-bottom: none;">
                                        <div class="category-grid-img d-flex align-items-center justify-content-center">
                                            <i class="bi bi-image text-muted" style="font-size: 2rem;"></i>
                                        </div>
                                    </div>
                                    
                                <?php elseif ($imgCount == 1): ?>
                                    <!-- 1 Image: Full Height -->
                                    <div class="category-grid-top" style="height: 100%; border-bottom: none;">
                                        <?= Html::img('/inventario-app/web/' . $cat->imagenes[0], ['class' => 'category-grid-img']) ?>
                                    </div>
                                    
                                <?php else: ?>
                                    <!-- 2+ Images: Standard Top -->
                                    <div class="category-grid-top">
                                        <?= Html::img('/inventario-app/web/' . $cat->imagenes[0], ['class' => 'category-grid-img']) ?>
                                    </div>
                                    
                                    <div class="category-grid-bottom">
                                        <?php if ($imgCount == 2): ?>
                                            <!-- 2 Images: Bottom image takes full width -->
                                            <div class="grid-img-half" style="width: 100%;">
                                                <?= Html::img('/inventario-app/web/' . $cat->imagenes[1], ['class' => 'category-grid-img']) ?>
                                            </div>
                                        <?php else: ?>
                                            <!-- 3 Images: Bottom split 50/50 -->
                                            <div class="grid-img-half">
                                                <?= Html::img('/inventario-app/web/' . $cat->imagenes[1], ['class' => 'category-grid-img']) ?>
                                            </div>
                                            <div class="grid-img-half">
                                                <?= Html::img('/inventario-app/web/' . $cat->imagenes[2], ['class' => 'category-grid-img']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?= Html::endTag('div') ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </section>

</div>
