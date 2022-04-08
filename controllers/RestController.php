<?php

namespace app\controllers;

use yii\web\Controller;
use app\logic\codes;

class RestController extends Controller
{
    public $enableCsrfValidation = false;
    protected $restData = '';
    protected $restIsOk = false;
    protected $restErr = '';
    protected $restExtendMessage = '';
    protected $listSetAction = []; // ОБАЗАТЕЛЬНО ПЕРЕОПРЕДЕЛИТЬ! Список экшенов, в которых присылаются данные для сохранения / обработки

    // запилил полный аналог из ларавеля)))
    protected function dd($arg) {
        dump($arg);
        exit;
    }

    public function returnError(string $err = ''):string {
        if (!$err) $err = $this->restErr;
        $errParams = codes::$restError[$err] ?? false;
        if ($errParams) {
            $returned = [
                'status' => 'error',
                'code' => $errParams['code'],
                'text' => $err,
                'message' => $errParams['mess']
            ];
            $restExtendMessage = trim($this->restExtendMessage);
            if ($restExtendMessage) {
                $returned['extendMessage'] = $restExtendMessage;
            }
        } else {
            $returned = [
                'status' => 'error',
                'code' => 0,
                'text' => 'UNKNOWN_ERROR',
                'message' => 'Не известная ошибка'
            ];
        }
        return json_encode($returned);
    }

    // Пстроен таким образом, что бы если прилетели ошибочные данные, то сам экшен даже не вызывался.
    public function beforeAction($action){
        $this->restIsOk = false;
        if (in_array($action->id, $this->listSetAction)) {
            if (!($_POST['data'] ?? false)) {
                $this->action->actionMethod = 'returnError';
                $this->restErr = 'NO_DATA';
            } elseif (!($this->restData = json_decode($_POST['data']))) {
                $this->action->actionMethod = 'returnError';
                $this->restErr = 'BAD_JSON';
            }
        }
        $this->restIsOk = true;

        return parent::beforeAction($action);
    }


    protected function returnResult($arrResult):string {
        if (!is_array($arrResult)) $arrResult = [(string)$arrResult];
        return json_encode(['status' => 'success', 'data' => $arrResult]);
    }

}
