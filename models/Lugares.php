<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lugares".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property string|null $ubicacion
 * @property string $created_at
 * @property string $updated_at
 */
class Lugares extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lugares';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'ubicacion'], 'default', 'value' => null],
            [['nombre'], 'required'],
            [['descripcion'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 200],
            [['ubicacion'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'ubicacion' => Yii::t('app', 'Ubicacion'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

}
