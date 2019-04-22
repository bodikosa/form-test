<?php

namespace app\components\servises;

use app\components\repositories\ UserRepository;
use app\models\modelChange\UserModel;

class UserManageService
{
    private $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function create(array $formData): UserModel
    {
        $userValue = UserModel::create($formData);
        $this->user->save($userValue);

        return $userValue;
    }
}