<?php
/**
 * Semantic URL model
 */

namespace app\models;


use yii\db\ActiveRecord;


class sURL extends ActiveRecord
{
    public static function tableName()
    {
        return 'surl';
    }

    public function getContent()
    {
        return $this->hasOne(Content::className(), ['id' => 'content_id']);
    }

    public function toString()
    {
        return $this->name;
    }
}