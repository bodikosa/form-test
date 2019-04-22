<?php

namespace app\controllers;
use app\components\servises\UserRegistrationManageService;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use Yii;

class RegisterFormController extends \yii\web\Controller
{
    private $userService;

    public function __construct($id, $module, UserRegistrationManageService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->userService = $service;
    }

    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                   /* 'store' => ['POST'],
                    'create' => ['GET'],*/
                ],
            ],
        ];
    }

    public function actionCreate()
    {
        $this->layout = false;
        return $this->render('create');
    }

    public function actionStore()
    {
        $data = '{
         "email" : "rsrssssrsddsdsfssrr@mail.ru",
         "password" : "11111111",
         "password_repeat" : "11111111",
         "categories" : [
             "category1",
             "category2",
             "category3"
         ],
         "address" : {
           "country" : "Ukraine",
           "city" : "Kovel",
           "address" : "Shevchenka 5"
         }
     }';

        $transaction = Yii::$app->db->beginTransaction();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        try {
            $response = $this->userService->create(Json::decode($data));
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            $response = $e->getMessage();
        }

        return $response;
    }
}
