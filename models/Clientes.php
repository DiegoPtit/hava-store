<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clientes".
 *
 * @property int $id
 * @property string|null $documento_identidad
 * @property string $nombre
 * @property string|null $ubicacion
 * @property string|null $telefono
 * @property int|null $edad
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 */
class Clientes extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const STATUS_MOROSO = 'Moroso';
    const STATUS_SOLVENTE = 'Solvente';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clientes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['documento_identidad', 'ubicacion', 'telefono', 'edad'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 'Solvente'],
            [['nombre'], 'required'],
            [['edad'], 'integer'],
            [['status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['documento_identidad'], 'string', 'max' => 100],
            [['nombre', 'ubicacion'], 'string', 'max' => 255],
            [['telefono'], 'string', 'max' => 80],
            ['status', 'in', 'range' => array_keys(self::optsStatus())],
            [['documento_identidad'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'documento_identidad' => Yii::t('app', 'Documento Identidad'),
            'nombre' => Yii::t('app', 'Nombre'),
            'ubicacion' => Yii::t('app', 'Ubicacion'),
            'telefono' => Yii::t('app', 'Telefono'),
            'edad' => Yii::t('app', 'Edad'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }


    /**
     * column status ENUM value labels
     * @return string[]
     */
    public static function optsStatus()
    {
        return [
            self::STATUS_MOROSO => Yii::t('app', 'Moroso'),
            self::STATUS_SOLVENTE => Yii::t('app', 'Solvente'),
        ];
    }

    /**
     * @return string
     */
    public function displayStatus()
    {
        return self::optsStatus()[$this->status];
    }

    /**
     * @return bool
     */
    public function isStatusMoroso()
    {
        return $this->status === self::STATUS_MOROSO;
    }

    public function setStatusToMoroso()
    {
        $this->status = self::STATUS_MOROSO;
    }

    /**
     * @return bool
     */
    public function isStatusSolvente()
    {
        return $this->status === self::STATUS_SOLVENTE;
    }

    public function setStatusToSolvente()
    {
        $this->status = self::STATUS_SOLVENTE;
    }
}
