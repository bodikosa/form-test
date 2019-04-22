<?php

namespace app\components\repositories;

use app\models\modelChange\UserModel;
use shop\repositories\NotFoundException;

class UserRepository extends BaseRepositary
{
    public function get($id): UserModel
    {
        if (!$brand = UserModel::findOne($id)) {
            throw new NotFoundException('User is not found.');
        }
        return $brand;
    }
}