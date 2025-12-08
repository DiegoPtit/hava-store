<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "facturas".
 *
 * @property int $id
 * @property int|null $id_cliente
 * @property string $codigo
 * @property string|null $concepto
 * @property float $monto_calculado
 * @property float $monto_final
 * @property string $currency
 * @property string $fecha
 * @property string $created_at
 * @property string $updated_at
 */
class Facturas extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const CURRENCY_USDT = 'USDT';
    const CURRENCY_BCV = 'BCV';
    const CURRENCY_VES = 'VES';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'facturas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cliente', 'concepto'], 'default', 'value' => null],
            [['monto_final'], 'default', 'value' => 0.00],
            [['currency'], 'default', 'value' => 'USDT'],
            [['fecha'], 'default', 'value' => 'curdate()'],
            [['id_cliente'], 'integer'],
            [['codigo'], 'required'],
            [['monto_calculado', 'monto_final'], 'number'],
            [['currency'], 'string'],
            [['fecha', 'created_at', 'updated_at'], 'safe'],
            [['codigo'], 'string', 'max' => 120],
            [['concepto'], 'string', 'max' => 255],
            ['currency', 'in', 'range' => array_keys(self::optsCurrency())],
            [['codigo'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_cliente' => Yii::t('app', 'Id Cliente'),
            'codigo' => Yii::t('app', 'Codigo'),
            'concepto' => Yii::t('app', 'Concepto'),
            'monto_calculado' => Yii::t('app', 'Monto Calculado'),
            'monto_final' => Yii::t('app', 'Monto Final'),
            'currency' => Yii::t('app', 'Currency'),
            'fecha' => Yii::t('app', 'Fecha'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }


    /**
     * column currency ENUM value labels
     * @return string[]
     */
    public static function optsCurrency()
    {
        return [
            self::CURRENCY_USDT => Yii::t('app', 'USDT'),
            self::CURRENCY_BCV => Yii::t('app', 'BCV'),
            self::CURRENCY_VES => Yii::t('app', 'VES'),
        ];
    }

    /**
     * @return string
     */
    public function displayCurrency()
    {
        return self::optsCurrency()[$this->currency];
    }

    /**
     * @return bool
     */
    public function isCurrencyUsdt()
    {
        return $this->currency === self::CURRENCY_USDT;
    }

    public function setCurrencyToUsdt()
    {
        $this->currency = self::CURRENCY_USDT;
    }

    /**
     * @return bool
     */
    public function isCurrencyBcv()
    {
        return $this->currency === self::CURRENCY_BCV;
    }

    public function setCurrencyToBcv()
    {
        $this->currency = self::CURRENCY_BCV;
    }

    /**
     * @return bool
     */
    public function isCurrencyVes()
    {
        return $this->currency === self::CURRENCY_VES;
    }

    public function setCurrencyToVes()
    {
        $this->currency = self::CURRENCY_VES;
    }
}
