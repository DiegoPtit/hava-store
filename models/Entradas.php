<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "entradas".
 *
 * @property int $id
 * @property int $id_producto
 * @property int $cantidad
 * @property int|null $id_proveedor
 * @property string|null $nro_documento
 * @property string|null $ruta_documento_respaldo
 * @property int $id_lugar
 * @property string $created_at
 */
class Entradas extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'entradas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_proveedor', 'nro_documento', 'ruta_documento_respaldo'], 'default', 'value' => null],
            [['id_producto', 'cantidad', 'id_lugar'], 'required'],
            [['id_producto', 'cantidad', 'id_proveedor', 'id_lugar'], 'integer'],
            [['created_at'], 'safe'],
            [['nro_documento'], 'string', 'max' => 255],
            [['ruta_documento_respaldo'], 'string', 'max' => 512],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_producto' => Yii::t('app', 'Id Producto'),
            'cantidad' => Yii::t('app', 'Cantidad'),
            'id_proveedor' => Yii::t('app', 'Id Proveedor'),
            'nro_documento' => Yii::t('app', 'Nro Documento'),
            'ruta_documento_respaldo' => Yii::t('app', 'Ruta Documento Respaldo'),
            'id_lugar' => Yii::t('app', 'Id Lugar'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

}
