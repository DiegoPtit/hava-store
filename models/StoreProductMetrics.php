<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "store_product_metrics".
 *
 * @property int $product_id
 * @property int $views
 * @property int $purchases
 * @property float $score
 * @property string|null $last_updated
 */
class StoreProductMetrics extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_product_metrics';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['last_updated'], 'default', 'value' => null],
            [['purchases'], 'default', 'value' => 0],
            [['score'], 'default', 'value' => 0.0000],
            [['product_id'], 'required'],
            [['product_id', 'views', 'purchases'], 'integer'],
            [['score'], 'number'],
            [['last_updated'], 'safe'],
            [['product_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => Yii::t('app', 'Product ID'),
            'views' => Yii::t('app', 'Views'),
            'purchases' => Yii::t('app', 'Purchases'),
            'score' => Yii::t('app', 'Score'),
            'last_updated' => Yii::t('app', 'Last Updated'),
        ];
    }

}
