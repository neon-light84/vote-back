<?php

namespace app\models;

use yii\db\ActiveRecord;

class VoteContents extends ActiveRecord
{

    public static function tableName()
    {
        return 'vote_contents';
    }

    public function getVote() {
        return $this->hasOne(Votes::class, ['id' => 'fk_votes']);
    }



}
