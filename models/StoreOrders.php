<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "store_orders".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $address_id
 * @property int|null $method_id
 * @property float $total
 * @property string $currency
 * @property string $status
 * @property string|null $payment_method
 * @property string|null $external_payment_id
 * @property string $created_at
 * @property string|null $updated_at
 */
class StoreOrders extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'address_id', 'method_id', 'payment_method', 'external_payment_id', 'updated_at'], 'default', 'value' => null],
            [['total'], 'default', 'value' => 0.00],
            [['currency'], 'default', 'value' => 'USD'],
            [['status'], 'default', 'value' => 'AWAITING_PAYMENT'],
            [['user_id', 'address_id', 'method_id'], 'integer'],
            [['total'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['currency'], 'string', 'max' => 10],
            [['status'], 'string', 'max' => 30],
            [['payment_method'], 'string', 'max' => 50],
            [['external_payment_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'address_id' => Yii::t('app', 'Address ID'),
            'method_id' => Yii::t('app', 'Method ID'),
            'total' => Yii::t('app', 'Total'),
            'currency' => Yii::t('app', 'Currency'),
            'status' => Yii::t('app', 'Status'),
            'payment_method' => Yii::t('app', 'Payment Method'),
            'external_payment_id' => Yii::t('app', 'External Payment ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

}
