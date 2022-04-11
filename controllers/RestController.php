<?php

namespace app\controllers;

use yii\web\Controller;
use app\logic\codes;

class RestController extends Controller
{
    public $enableCsrfValidation = false;
    public $layout = 'rest';
    protected  $restRequestData = [];
    protected bool $restRequestIsOk = false;
    protected string $restErr = '';
    protected string $restExtendMessage = '';
    protected array $listSetAction = []; // ОБАЗАТЕЛЬНО ПЕРЕОПРЕДЕЛИТЬ! Список экшенов, в которых присылаются данные для сохранения / обработки

    // запилил полный аналог из ларавеля)))
    protected function dd($arg = '') {
        dump($arg);
        exit;
    }

    // Пстроен таким образом, что бы если прилетели ошибочные данные, то сам экшен даже не вызывался.
    public function beforeAction($action){
        $this->restRequestIsOk = true;

        // Обработка экшенов, которые присылают данные
        if (in_array($action->id, $this->listSetAction)) {
            if (!($_POST['data'] ?? false)) {
                $this->restRequestIsOk = false;
                $this->restErr = 'NO_DATA';
            } elseif (!($this->restRequestData = json_decode($_POST['data'], true))) {
                $this->restRequestIsOk = false;
                $this->restErr = 'BAD_JSON';
            }
        }

        if (!$this->restRequestIsOk) {
            $this->action->actionMethod = 'restResponseError';
        }

        return parent::beforeAction($action);
    }

    public function restResponseError(string $err = '', string $restExtendMessage = ''):string {
        if (!$err) $err = $this->restErr;
        if (!$restExtendMessage) $restExtendMessage = $this->restExtendMessage;
        $err = trim($err);
        $restExtendMessage = trim($restExtendMessage);
        $errParams = codes::$restError[$err] ?? false;
        if ($errParams) {
            $restData = [
                'status' => 'error',
                'code' => $errParams['code'],
                'text' => $err,
                'message' => $errParams['mess']
            ];
        } else {
            $restData = [
                'status' => 'error',
                'code' => 0,
                'text' => 'UNKNOWN_ERROR',
                'message' => 'Не известная ошибка'
            ];
        }
        if ($restExtendMessage) {
            $restData['extendMessage'] = $restExtendMessage;
        }

        return $this->renderFile('@app/views/rest-error.php', compact('restData') );
    }

    protected function restResponseOk($restData):string {
        return $this->renderFile('@app/views/rest-ok.php', compact('restData') );
    }

}
