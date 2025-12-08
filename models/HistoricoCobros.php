<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "historico_cobros".
 *
 * @property int $id
 * @property int $id_cliente
 * @property int|null $id_factura
 * @property string $fecha
 * @property float $monto
 * @property string $currency
 * @property string|null $metodo_pago
 * @property string|null $nota
 */
class HistoricoCobros extends \yii\db\ActiveRecord
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
        return 'historico_cobros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_factura', 'metodo_pago', 'nota'], 'default', 'value' => null],
            [['monto'], 'default', 'value' => 0.00],
            [['currency'], 'default', 'value' => 'USDT'],
            [['id_cliente'], 'required'],
            [['id_cliente', 'id_factura'], 'integer'],
            [['fecha'], 'safe'],
            [['monto'], 'number'],
            [['currency', 'nota'], 'string'],
            [['metodo_pago'], 'string', 'max' => 100],
            ['currency', 'in', 'range' => array_keys(self::optsCurrency())],
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
            'id_factura' => Yii::t('app', 'Id Factura'),
            'fecha' => Yii::t('app', 'Fecha'),
            'monto' => Yii::t('app', 'Monto'),
            'currency' => Yii::t('app', 'Currency'),
            'metodo_pago' => Yii::t('app', 'Metodo Pago'),
            'nota' => Yii::t('app', 'Nota'),
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
