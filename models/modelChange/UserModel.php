<?php

namespace app\models\modelChange;

use app\models\User;
use Yii;
use yii\helpers\ArrayHelper;

class UserModel extends User
{
    public function setPassword($password): string
    {
        return Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey(): string
    {
        return Yii::$app->security->generateRandomString();
    }

    public static function create($params): self
    {
        $brand = new static();
        $params['password_hash'] = $brand->setPassword(ArrayHelper::getValue($params, 'password'));
        $params['auth_key'] = $brand->generateAuthKey();
        $brand->load($params, '');

        return $brand;
    }
}
