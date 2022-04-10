<?php

namespace app\controllers;
use Yii;

class TestFormController extends RestController
{
    protected array $listSetAction = ['register'];
    public function actionRegister() {

        return $this->restResponseOk(['Спасибо, данные приняты']);
    }

    public function actionGetData() {
        $ret = [
            'name' => 'Пашок',
            'family' => 'Горошников',
            'age' => '37',
            'sex' => 'муж',
        ];
        return $this->restResponseOk($ret);
    }

}
