<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "store_order_items".
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $cantidad
 * @property float $price_snapshot
 * @property string|null $sku
 * @property string $created_at
 */
class StoreOrderItems extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_order_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sku'], 'default', 'value' => null],
            [['cantidad'], 'default', 'value' => 1],
            [['order_id', 'product_id', 'price_snapshot'], 'required'],
            [['order_id', 'product_id', 'cantidad'], 'integer'],
            [['price_snapshot'], 'number'],
            [['created_at'], 'safe'],
            [['sku'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'cantidad' => Yii::t('app', 'Cantidad'),
            'price_snapshot' => Yii::t('app', 'Price Snapshot'),
            'sku' => Yii::t('app', 'Sku'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

}
