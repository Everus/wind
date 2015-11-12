<?php

namespace app\models;

use yii\db\ActiveRecord;


class Content extends ActiveRecord
{
    public function setSURLString($sURL)
    {
        if($this->getSURLString() !== $sURL) {
            $sURLModel = new sURL();
            $sURLModel->name = $sURL;
            $sURLModel->save(true, ['name']);
            $this->link('sURL', $sURLModel);
        }
        return $this;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->sURL->link('content', $this);
            return true;
        } else {
            return false;
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
    }
    public function getSURLString()
    {
        if($this->isNewRecord) {
            return '';
        }
        return $this->sURL->toString();
    }

    public static function tableName()
    {
        return 'content';
    }

    public function rules()
    {
        return [
            [['title', 'body'], 'string'],
            [['title', 'body'], 'required'],
            [['sURLString'], 'string', 'length' => [4, 255]],
            ['sURLString', 'match', 'pattern' => '/^[a-z0-9]+/'],
            [['id'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'body' => 'Content',
            'sURLString' => 'Semantic URL',
            'fullURL' => 'Semantic URL',
        ];
    }

    public function getSURL()
    {
        return $this->hasOne(sURL::className(), ['id' => 'surl_id']);
    }

    public function getHistory()
    {
        return $this->hasMany(sURL::className(), ['content_id' => 'id']);
    }

    public static function findOneByURL($url)
    {
        return Content::find()
            ->select('content.*')
            ->leftJoin('surl', 'surl.content_id = content.id')
            ->where(['surl.name' => $url])
            ->one();
    }
}