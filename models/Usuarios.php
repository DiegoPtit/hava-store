<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $id
 * @property string $nombre
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string|null $access_token
 * @property string|null $auth_key
 * @property int $admin
 * @property string|null $google_id
 * @property string|null $google_access_token
 * @property string $created_at
 * @property string $updated_at
 * @property int $modalClosed
 * @property string|null $dateModalClosed
 */
class Usuarios extends \yii\db\ActiveRecord implements IdentityInterface
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['access_token', 'auth_key', 'google_id', 'google_access_token'], 'default', 'value' => null],
            [['admin'], 'default', 'value' => 0],
            [['id', 'nombre', 'username', 'email', 'password_hash', 'modalClosed'], 'required'],
            [['id', 'admin', 'modalClosed'], 'integer'],
            [['created_at', 'updated_at', 'dateModalClosed'], 'safe'],
            [['nombre', 'email', 'password_hash', 'access_token', 'auth_key', 'google_id', 'google_access_token'], 'string', 'max' => 255],
            [['username'], 'string', 'max' => 100],
            [['username'], 'unique'],
            [['id'], 'unique'],
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
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'access_token' => Yii::t('app', 'Access Token'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'admin' => Yii::t('app', 'Admin'),
            'google_id' => Yii::t('app', 'Google ID'),
            'google_access_token' => Yii::t('app', 'Google Access Token'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'modalClosed' => Yii::t('app', 'Modal Closed'),
            'dateModalClosed' => Yii::t('app', 'Date Modal Closed'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
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
}
