<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "store_payments".
 *
 * @property int $id
 * @property int $order_id
 * @property string|null $gateway
 * @property string|null $gateway_payment_id
 * @property float $amount
 * @property string|null $status
 * @property string|null $payment_support_image
 * @property string|null $raw_response
 * @property string $created_at
 */
class StorePayments extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_payments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gateway', 'gateway_payment_id', 'payment_support_image', 'raw_response'], 'default', 'value' => null],
            [['amount'], 'default', 'value' => 0.00],
            [['status'], 'default', 'value' => 'PENDING'],
            [['order_id'], 'required'],
            [['order_id'], 'integer'],
            [['amount'], 'number'],
            [['raw_response'], 'string'],
            [['created_at'], 'safe'],
            [['gateway'], 'string', 'max' => 100],
            [['gateway_payment_id'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 30],
            [['payment_support_image'], 'string', 'max' => 511],
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
            'gateway' => Yii::t('app', 'Gateway'),
            'gateway_payment_id' => Yii::t('app', 'Gateway Payment ID'),
            'amount' => Yii::t('app', 'Amount'),
            'status' => Yii::t('app', 'Status'),
            'payment_support_image' => Yii::t('app', 'Payment Support Image'),
            'raw_response' => Yii::t('app', 'Raw Response'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

}
