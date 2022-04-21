<?php

namespace app\models;

use yii\db\ActiveRecord;

class VoteContents extends ActiveRecord
{

    public static function tableName()
    {
        return 'vote_contents';
    }


}
