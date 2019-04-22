<?php

namespace app\components\servises;

use app\components\jobs\WriteJob;
use Yii;
use yii\helpers\ArrayHelper;


class UserRegistrationManageService
{
    private $user;
    private $userAddress;
    private $userCategory;


    public function __construct(UserManageService $user, UserAddressService $userAddress, UserCategoryManageService $userCategory)
    {
        $this->user = $user;
        $this->userAddress = $userAddress;
        $this->userCategory = $userCategory;
    }

    public function create(array $formData): array
    {
        $userData = $this->user->create($formData);
        $userCategory = $this->userCategory->createData($userData->id, ArrayHelper::getValue($formData, 'categories', []));

        $addressParams = ArrayHelper::getValue($formData, 'address', []);
        $addressParams['user_id'] = $userData->id;
        $userAddress = $this->userAddress->create($addressParams);

        $this->sendMessage($userData->username);

        return compact('userData', 'userCategory', 'userAddress');
    }

    private function sendMessage(string $nameUser)
    {
        Yii::$app->queue->push(new WriteJob([
            'message' => "User {$nameUser} have been registerd!",
            'to' => 'admin@gmail.com'
        ]));
    }
}