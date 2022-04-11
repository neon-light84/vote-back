<?php

namespace app\controllers;

use app\logic\Sanitizer;

class TestFormController extends RestController
{
    protected array $listSetAction = ['register'];

    public function actionRegister() {
        Sanitizer::sanitise($this->restRequestData, ['name' => ['space_around']]);

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
