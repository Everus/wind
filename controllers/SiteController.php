<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
use app\models\Content;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionShow()
    {
        $request = Yii::$app->request;
        $surl = $request->get('surl');
        $content = Content::find()
            ->select('content.*')
            ->leftJoin('surl', 'surl.content_id = content.id')
            ->where(['surl.name' => $surl])
            ->one();
        if(!$content) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        if($content->getSURLString() !== $surl) {
            return $this->redirect(Url::toRoute([
                'posts/'.$content->getSURLString(),
            ]));
        }
        return $this->render('index', [
            'content' => $content,
        ]);
    }
}
