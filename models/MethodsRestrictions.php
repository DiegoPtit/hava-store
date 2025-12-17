<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "methods_restrictions".
 *
 * @property int $id
 * @property int $method_id
 * @property int $has_banco
 * @property int $has_titular
 * @property int $has_numero_cuenta
 * @property int $has_telefono
 * @property int $has_cedula
 * @property string $created_at
 */
class MethodsRestrictions extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'methods_restrictions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['has_cedula'], 'default', 'value' => 0],
            [['method_id'], 'required'],
            [['method_id', 'has_banco', 'has_titular', 'has_numero_cuenta', 'has_telefono', 'has_cedula'], 'integer'],
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
            'method_id' => Yii::t('app', 'Method ID'),
            'has_banco' => Yii::t('app', 'Has Banco'),
            'has_titular' => Yii::t('app', 'Has Titular'),
            'has_numero_cuenta' => Yii::t('app', 'Has Numero Cuenta'),
            'has_telefono' => Yii::t('app', 'Has Telefono'),
            'has_cedula' => Yii::t('app', 'Has Cedula'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

}
