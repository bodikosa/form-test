<?php
/**
 * Created by PhpStorm.
 * User: mrbsk
 * Date: 21.04.19
 * Time: 18:54
 */

namespace app\components\repositories;


use yii\db\ActiveRecord;

abstract class BaseRepositary
{
    public function save(ActiveRecord $brand): void
    {
        if (!$brand->save() || $brand->hasErrors()) {
            throw new \RuntimeException(json_encode($brand->getErrors()));
        }
    }

}