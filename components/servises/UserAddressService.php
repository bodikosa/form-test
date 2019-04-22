<?php

namespace app\components\servises;

use app\components\repositories\{ UserAddressRepository, UserCategoryRepository, UserRepository };
use app\models\modelChange\UserModel;
use app\models\UserAddress;
use shop\entities\Shop\Brand;
use yii\helpers\ArrayHelper;


class UserAddressService
{
    private $userAddress;

    public function __construct(UserAddressRepository $userAddress)
    {
        $this->userAddress = $userAddress;
    }

    public function create(array $formData): UserAddress
    {
        $model = new UserAddress();
        $model->load($formData, '');
        $this->userAddress->save($model);

        return $model;
    }


}