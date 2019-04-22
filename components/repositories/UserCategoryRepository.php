<?php

namespace app\components\repositories;

use common\models\User;
use shop\repositories\NotFoundException;

class UserCategoryRepository extends BaseRepositary
{
    public function get($id): UserCategoryRepository
    {
        if (!$brand = UserCategoryRepository::findOne($id)) {
            throw new NotFoundException('User is not found.');
        }
        return $brand;
    }
}