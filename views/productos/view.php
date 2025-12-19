<?php

/** @var yii\web\View $this */
/** @var app\models\Productos $producto */
/** @var mixed $precioOficial */
/** @var mixed $precioParalelo */

use yii\helpers\Html;
use yii\helpers\Url;

// Construir título del producto
$titulo_partes = array_filter([$producto->marca, $producto->modelo, $producto->color]);
$titulo = implode(' - ', $titulo_partes) ?: 'Producto #' . $producto->id;

$this->title = $titulo;

$this->registerCss('
/* Main Container */
.product-view-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 30px 15px;
}

/* Two Column Layout */
.product-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 30px;
    margin-bottom: 40px;
}

@media (min-width: 992px) {
    .product-grid {
        grid-template-columns: 1fr 1fr;
    }
}

/* Left Column - Product Info Card */
.product-main-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    padding: 30px;
    border: 1px solid #f0f0f0;
}

/* Header with Title and Rating */
.product-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 25px;
    gap: 15px;
}

.product-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 0;
    flex: 1;
}

.product-rating {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-shrink: 0;
}

.rating-stars {
    display: flex;
    gap: 3px;
    color: #ffc107;
    font-size: 1.2rem;
}

.rating-number {
    font-size: 0.9rem;
    color: #6c757d;
    font-weight: 600;
}

/* Image Carousel */
.product-carousel {
    position: relative;
    width: 100%;
    margin-bottom: 30px;
    background: #f8f9fa;
    border-radius: 15px;
    overflow: hidden;
}

.carousel-main-image {
    width: 100%;
    height: 400px;
    object-fit: contain;
    padding: 20px;
    background: white;
}

.carousel-thumbnails {
    display: flex;
    gap: 10px;
    padding: 15px;
    overflow-x: auto;
    scroll-behavior: smooth;
    -webkit-overflow-scrolling: touch;
}

.carousel-thumbnails::-webkit-scrollbar {
    height: 6px;
}

.carousel-thumbnails::-webkit-scrollbar-thumb {
    background: #dee2e6;
    border-radius: 3px;
}

.carousel-thumbnail {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    cursor: pointer;
    border: 2px solid transparent;
    transition: all 0.3s ease;
    flex-shrink: 0;
}

.carousel-thumbnail:hover,
.carousel-thumbnail.active {
    border-color: #007bff;
    transform: scale(1.05);
}

.carousel-placeholder {
    width: 100%;
    height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
}

/* Price Section */
.product-price-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 25px;
}

.price-label {
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.price-main {
    font-size: 2.5rem;
    font-weight: 800;
    color: white;
    margin-bottom: 10px;
    display: flex;
    align-items: baseline;
    gap: 10px;
}

.price-currency {
    font-size: 0.5em;
    font-weight: 600;
    opacity: 0.9;
}

.price-converted {
    font-size: 1.1rem;
    color: rgba(255, 255, 255, 0.95);
    font-weight: 600;
}

/* Stock Badge */
.stock-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 20px;
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    color: white;
    border-radius: 50px;
    font-weight: 700;
    font-size: 1rem;
    margin-bottom: 25px;
    box-shadow: 0 4px 12px rgba(17, 153, 142, 0.3);
}

.stock-badge i {
    font-size: 1.2rem;
}

.stock-low {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.stock-out {
    background: linear-gradient(135deg, #757575 0%, #bdbdbd 100%);
}

/* Buy Button */
.btn-buy-now {
    width: 100%;
    padding: 18px;
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    border: none;
    border-radius: 15px;
    font-size: 1.2rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
    margin-bottom: 30px;
}

.btn-buy-now:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.5);
}

.btn-buy-now:active {
    transform: translateY(0);
}

.btn-buy-now:disabled {
    background: linear-gradient(135deg, #adb5bd 0%, #6c757d 100%);
    cursor: not-allowed;
    box-shadow: none;
}

/* Characteristics List */
.product-characteristics {
    margin-bottom: 30px;
}

.characteristics-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.characteristics-title i {
    color: #007bff;
}

.characteristic-item {
    display: flex;
    padding: 12px 15px;
    background: #f8f9fa;
    border-radius: 10px;
    margin-bottom: 10px;
    transition: all 0.3s ease;
}

.characteristic-item:hover {
    background: #e9ecef;
    transform: translateX(5px);
}

.characteristic-label {
    font-weight: 600;
    color: #6c757d;
    min-width: 150px;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
}

.characteristic-value {
    color: #2c3e50;
    font-weight: 600;
}

/* Category Badge */
.product-category-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 18px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.95rem;
    margin-bottom: 25px;
}

/* Right Column - Description Card */
.product-description-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    padding: 30px;
    border: 1px solid #f0f0f0;
    height: fit-content;
}

.description-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.description-title i {
    color: #764ba2;
}

.description-content {
    font-size: 1rem;
    line-height: 1.8;
    color: #495057;
    text-align: justify;
}

.description-empty {
    color: #adb5bd;
    font-style: italic;
    text-align: center;
    padding: 40px 20px;
}

/* Responsive */
@media (max-width: 991px) {
    .product-title {
        font-size: 1.5rem;
    }
    
    .product-header {
        flex-direction: column;
    }
    
    .price-main {
        font-size: 2rem;
    }
    
    .carousel-main-image {
        height: 300px;
    }
}

@media (max-width: 576px) {
    .product-main-card,
    .product-description-card {
        padding: 20px;
    }
    
    .characteristic-label {
        min-width: 120px;
    }
}
');

$this->registerJs("
(function() {
    // Carousel functionality
    const thumbnails = document.querySelectorAll('.carousel-thumbnail');
    const mainImage = document.getElementById('carousel-main-image');
    
    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function() {
            thumbnails.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            mainImage.src = this.dataset.src;
        });
    });
    
    // Set first thumbnail as active
    if (thumbnails.length > 0) {
        thumbnails[0].classList.add('active');
    }
})();
", \yii\web\View::POS_END);
?>

<div class="product-view-container">
    <div class="product-grid">
        
        <!-- LEFT COLUMN: Product Information -->
        <div class="product-main-card">
            
            <!-- Header: Title + Rating -->
            <div class="product-header">
                <h1 class="product-title"><?= Html::encode($titulo) ?></h1>
                <div class="product-rating">
                    <div class="rating-stars">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-half"></i>
                    </div>
                    <span class="rating-number">4.5</span>
                </div>
            </div>
            
            <!-- Image Carousel -->
            <?php
            $fotos = [];
            if (!empty($producto->fotos)) {
                $fotosArray = json_decode($producto->fotos, true);
                if (is_array($fotosArray)) {
                    $fotos = $fotosArray;
                }
            }
            ?>
            
            <div class="product-carousel">
                <?php if (!empty($fotos)): ?>
                    <img id="carousel-main-image" 
                         src="/inventario-app/web/<?= Html::encode($fotos[0]) ?>" 
                         alt="<?= Html::encode($titulo) ?>" 
                         class="carousel-main-image">
                    
                    <?php if (count($fotos) > 1): ?>
                        <div class="carousel-thumbnails">
                            <?php foreach ($fotos as $foto): ?>
                                <img src="/inventario-app/web/<?= Html::encode($foto) ?>" 
                                     alt="Thumbnail" 
                                     class="carousel-thumbnail"
                                     data-src="/inventario-app/web/<?= Html::encode($foto) ?>">
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="carousel-placeholder">
                        <i class="bi bi-image text-muted" style="font-size: 4rem;"></i>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Price Section -->
            <div class="product-price-section">
                <div class="price-label">Precio</div>
                <div class="price-main">
                    $<?= number_format($producto->precio_venta, 2) ?>
                    <span class="price-currency">USDT</span>
                </div>
                <?php if ($precioParalelo && $precioOficial && $precioOficial->precio_ves > 0): ?>
                    <?php
                    $precioVes = $producto->precio_venta * $precioParalelo->precio_ves;
                    $precioBs = $precioVes / $precioOficial->precio_ves;
                    ?>
                    <div class="price-converted">
                        ≈ Bs. <?= number_format($precioBs, 2) ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Stock Badge -->
            <?php
            $stockTotal = $producto->stock ?? 0;
            $stockClass = '';
            $stockIcon = 'bi-check-circle-fill';
            $stockText = 'En Stock';
            
            if ($stockTotal <= 0) {
                $stockClass = 'stock-out';
                $stockIcon = 'bi-x-circle-fill';
                $stockText = 'Agotado';
            } elseif ($stockTotal <= 5) {
                $stockClass = 'stock-low';
                $stockIcon = 'bi-exclamation-circle-fill';
                $stockText = 'Stock Bajo';
            }
            ?>
            <div class="stock-badge <?= $stockClass ?>">
                <i class="bi <?= $stockIcon ?>"></i>
                <span><?= $stockText ?>: <?= $stockTotal ?> unidades</span>
            </div>
            
            <!-- Buy Now Button -->
            <button class="btn-buy-now" <?= ($stockTotal <= 0) ? 'disabled' : '' ?>>
                <i class="bi bi-cart-check-fill me-2"></i>
                <?= ($stockTotal > 0) ? 'Comprar Ahora' : 'No Disponible' ?>
            </button>
            
            <!-- Characteristics List -->
            <div class="product-characteristics">
                <h3 class="characteristics-title">
                    <i class="bi bi-list-check"></i>
                    Características
                </h3>
                
                <?php if ($producto->marca): ?>
                    <div class="characteristic-item">
                        <span class="characteristic-label">Marca:</span>
                        <span class="characteristic-value"><?= Html::encode($producto->marca) ?></span>
                    </div>
                <?php endif; ?>
                
                <?php if ($producto->modelo): ?>
                    <div class="characteristic-item">
                        <span class="characteristic-label">Modelo:</span>
                        <span class="characteristic-value"><?= Html::encode($producto->modelo) ?></span>
                    </div>
                <?php endif; ?>
                
                <?php if ($producto->color): ?>
                    <div class="characteristic-item">
                        <span class="characteristic-label">Color:</span>
                        <span class="characteristic-value"><?= Html::encode($producto->color) ?></span>
                    </div>
                <?php endif; ?>
                
                <?php if ($producto->contenido_neto && $producto->unidad_medida): ?>
                    <div class="characteristic-item">
                        <span class="characteristic-label">Contenido Neto:</span>
                        <span class="characteristic-value">
                            <?= Html::encode($producto->contenido_neto) ?> <?= Html::encode($producto->unidad_medida) ?>
                        </span>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Category Badge -->
            <?php if ($producto->categoria): ?>
                <div class="product-category-badge">
                    <i class="bi bi-tag-fill"></i>
                    <span><?= Html::encode($producto->categoria->titulo) ?></span>
                </div>
            <?php endif; ?>
            
        </div>
        
        <!-- RIGHT COLUMN: Description -->
        <div class="product-description-card">
            <h2 class="description-title">
                <i class="bi bi-info-circle-fill"></i>
                Descripción del Producto
            </h2>
            
            <?php if ($producto->descripcion): ?>
                <div class="description-content">
                    <?= nl2br(Html::encode($producto->descripcion)) ?>
                </div>
            <?php else: ?>
                <div class="description-empty">
                    <i class="bi bi-file-text" style="font-size: 3rem; margin-bottom: 15px; display: block;"></i>
                    <p>No hay descripción disponible para este producto.</p>
                </div>
            <?php endif; ?>
        </div>
        
    </div>
</div>
