<?php

namespace app\models;

use yii\db\ActiveRecord;

class Votes extends ActiveRecord
{

    public static function tableName()
    {
        return 'votes';
    }

    public function getContent() {
        return $this->hasMany(VoteContents::class, ['fk_votes' => 'id']);
    }

}
