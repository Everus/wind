<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
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
        if(!$content = Content::findOneByURL($surl)) {
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
