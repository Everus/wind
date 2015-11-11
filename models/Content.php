<?php

namespace app\models;

use yii\db\ActiveRecord;


class Content extends ActiveRecord
{
    public static function tableName()
    {
        return 'content';
    }

    public function getSURL()
    {
        return $this->hasOne(SURL::className(), ['id' => 'surl_id']);
    }

    public function getHistory()
    {
        return $this->hasMany(SURL::className(), ['content_id' => 'id']);
    }
}