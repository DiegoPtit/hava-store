<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stock".
 *
 * @property int $id
 * @property int $id_producto
 * @property int $id_lugar
 * @property int $cantidad
 * @property string $updated_at
 */
class Stock extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stock';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cantidad'], 'default', 'value' => 0],
            [['id_producto', 'id_lugar'], 'required'],
            [['id_producto', 'id_lugar', 'cantidad'], 'integer'],
            [['updated_at'], 'safe'],
            [['id_producto', 'id_lugar'], 'unique', 'targetAttribute' => ['id_producto', 'id_lugar']],
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
            'id_lugar' => Yii::t('app', 'Id Lugar'),
            'cantidad' => Yii::t('app', 'Cantidad'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

}
