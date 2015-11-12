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

    public function setSURLString($link)
    {
        $this->surl = new SURL();
        $this->surl->name = $link;
        return $this;
    }

    public function getSURLString()
    {
        return $this->surl->toString();
    }
}