<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "store_users".
 *
 * @property int $id
 * @property string $email
 * @property string $password_hash
 * @property string|null $nombre
 * @property string|null $telefono
 * @property string $created_at
 * @property string|null $updated_at
 */
class StoreUsers extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'telefono', 'updated_at'], 'default', 'value' => null],
            [['email', 'password_hash'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['email', 'password_hash'], 'string', 'max' => 255],
            [['nombre'], 'string', 'max' => 150],
            [['telefono'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'Email'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'nombre' => Yii::t('app', 'Nombre'),
            'telefono' => Yii::t('app', 'Telefono'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

}
