<?php

namespace app\components\servises;

use app\components\repositories\{ UserAddressRepository, UserCategoryRepository, UserRepository };
use app\models\modelChange\UserModel;
use app\models\UserAddress;
use app\models\UserCategory;
use shop\entities\Shop\Brand;
use yii\helpers\ArrayHelper;


class UserCategoryManageService
{
    private $userCategories;

    public function __construct(UserCategoryRepository $userCategoryRepository)
    {
        $this->userCategories = $userCategoryRepository;
    }

    public function create(array $formData): UserCategory
    {
        $model = new UserCategory();
        $model->load($formData, '');
        $this->userCategories->save($model);

        return $model;
    }

    public function createData(int $id_user, array $categories)
    {
        $createData = [];
        foreach ($categories as $categoryName) {
            $createData[] = $this->create(['user_id' => $id_user, 'name' => $categoryName]);
        }

        return $createData;
    }
}