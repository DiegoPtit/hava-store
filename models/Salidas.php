<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "salidas".
 *
 * @property int $id
 * @property int $id_producto
 * @property int $cantidad
 * @property int $is_movimiento
 * @property int|null $id_lugar_origen
 * @property int|null $id_lugar_destino
 * @property int|null $id_cliente
 * @property string $created_at
 */
class Salidas extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'salidas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_lugar_origen', 'id_lugar_destino', 'id_cliente'], 'default', 'value' => null],
            [['is_movimiento'], 'default', 'value' => 0],
            [['id_producto', 'cantidad'], 'required'],
            [['id_producto', 'cantidad', 'is_movimiento', 'id_lugar_origen', 'id_lugar_destino', 'id_cliente'], 'integer'],
            [['created_at'], 'safe'],
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
            'is_movimiento' => Yii::t('app', 'Is Movimiento'),
            'id_lugar_origen' => Yii::t('app', 'Id Lugar Origen'),
            'id_lugar_destino' => Yii::t('app', 'Id Lugar Destino'),
            'id_cliente' => Yii::t('app', 'Id Cliente'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

}
