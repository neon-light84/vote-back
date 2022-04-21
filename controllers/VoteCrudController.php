<?php

namespace app\controllers;

use app\logic\Sanitizer;
use app\models\Votes;

class VoteCrudController extends RestController
{
    protected array $listSetAction = ['register'];

    public function actionCreate() {
        // получить такой джесон header, description, fn_type_diagramm, is_multi_select, is_display_result
//        $vote = Votes::find()->asArray()->with('content')->all();
//        $vote = Votes::find()->asArray()->all();
        $vote = Votes::find()->all();

        $a=4;

        return $this->render('test', compact('vote'));
    }

    public function actionRegister() {
        Sanitizer::sanitise($this->restRequestData, ['name' => ['space_around']]);

        return $this->restResponseOk(['Спасибо, данные приняты']);
    }

    public function actionGetVotes() {
        $votes = Votes::find()->asArray()->all();

        return $this->restResponseOk($votes);
    }

    public function actionGetVoteDetail() {
        $id = $this->restRequestData['vote_id'];
        $vote = Votes::find()->asArray()->with('content')->where(['id' => $id])->one();

        return $this->restResponseOk($vote);
    }

}
