<?php

namespace app\controllers;

use app\logic\Sanitizer;
use app\models\VoteContents;
use app\models\Votes;

class VoteCrudController extends RestController
{
    protected array $listSetAction = ['register'];

    public function actionCreate() {
        // получить такой джесон header, description, fn_type_diagramm, is_multi_select, is_display_result

        $testOne = VoteContents::find(2)->asArray()->with('vote')->one();

        $vote = Votes::find(5)->with('content')->one();
//        $vote = Votes::find()->asArray()->all();
//        $vote = Votes::find()->all();

//        $nv = new Votes();
//        $nv->header = 'Какой автомобиль по душе?';
//        $nv->is_display_result = true;
//        $
//        $nv->save();


        $content = new VoteContents();
        $content->item_id = 1;
        $content->item_display = "1111";
        $content->item_position = 1;
        $content->link('vote', $vote);

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
