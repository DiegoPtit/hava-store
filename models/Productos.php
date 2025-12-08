<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productos".
 *
 * @property int $id
 * @property string|null $marca
 * @property string|null $modelo
 * @property string|null $color
 * @property string|null $descripcion
 * @property float|null $contenido_neto
 * @property string|null $unidad_medida
 * @property float $costo
 * @property float $precio_venta
 * @property string|null $codigo_barra
 * @property int|null $id_lugar
 * @property int|null $id_categoria
 * @property string|null $fotos
 * @property string|null $sku
 * @property string $created_at
 * @property string $updated_at
 */
class Productos extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['marca', 'modelo', 'color', 'descripcion', 'contenido_neto', 'unidad_medida', 'codigo_barra', 'id_lugar', 'id_categoria', 'fotos', 'sku'], 'default', 'value' => null],
            [['precio_venta'], 'default', 'value' => 0.00],
            [['descripcion', 'fotos'], 'string'],
            [['contenido_neto', 'costo', 'precio_venta'], 'number'],
            [['id_lugar', 'id_categoria'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['marca', 'modelo'], 'string', 'max' => 150],
            [['color'], 'string', 'max' => 80],
            [['unidad_medida'], 'string', 'max' => 50],
            [['codigo_barra', 'sku'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'marca' => Yii::t('app', 'Marca'),
            'modelo' => Yii::t('app', 'Modelo'),
            'color' => Yii::t('app', 'Color'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'contenido_neto' => Yii::t('app', 'Contenido Neto'),
            'unidad_medida' => Yii::t('app', 'Unidad Medida'),
            'costo' => Yii::t('app', 'Costo'),
            'precio_venta' => Yii::t('app', 'Precio Venta'),
            'codigo_barra' => Yii::t('app', 'Codigo Barra'),
            'id_lugar' => Yii::t('app', 'Id Lugar'),
            'id_categoria' => Yii::t('app', 'Id Categoria'),
            'fotos' => Yii::t('app', 'Fotos'),
            'sku' => Yii::t('app', 'Sku'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

}
