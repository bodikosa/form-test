<?php

namespace app\components\repositories;

use app\models\UserAddress;
use shop\repositories\NotFoundException;

class UserAddressRepository extends BaseRepositary
{
    public function get($id): UserAddress
    {
        if (!$brand = UserAddress::findOne($id)) {
            throw new NotFoundException('User is not found.');
        }
        return $brand;
    }
}