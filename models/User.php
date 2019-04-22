<?php

namespace app\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_hash_repeat
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property UserAddress[] $userAddresses
 * @property UserCategory[] $userCategories
 */
class User extends \yii\db\ActiveRecord
{
    const SCENARIO_CREATE = 'create';

    public $password_repeat;
    public $password;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    public function beforeValidate() {
        if ($this->isNewRecord) {
            $this->username = 'test_name' . time();
            $this->created_at = time();
        }

        $this->updated_at = time();

        return parent::beforeValidate();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key','password', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['password_repeat'], 'required', 'on' => self::SCENARIO_CREATE],
            [['status', 'created_at', 'updated_at'], 'integer'],
            ['password', 'compare', 'compareAttribute' => 'password_repeat', 'message' => 'Not equal password'],
            [['username', 'password_hash', 'password', 'password_reset_token', 'email', 'password_repeat'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_hash_repeat' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAddresses()
    {
        return $this->hasMany(UserAddress::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserCategories()
    {
        return $this->hasMany(UserCategory::className(), ['user_id' => 'id']);
    }
}
