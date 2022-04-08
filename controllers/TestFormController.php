<?php

namespace app\controllers;

class TestFormController extends RestController
{
    protected $listSetAction = ['register'];
    public function actionRegister() {

        return $this->returnResult(['Спасибо, данные приняты']);
    }

    public function actionGetData() {
        $ret = [
            'name' => 'Пашок',
            'family' => 'Горошников',
            'age' => '37',
            'sex' => 'муж',
        ];
        return $this->returnResult($ret);
    }

}
