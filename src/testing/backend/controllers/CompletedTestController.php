<?php
/**
 * Created by PhpStorm.
 * User: Aritomo
 * Date: 17.03.2019
 * Time: 19:35
 */

namespace backend\controllers;


use common\models\PassDetail;
use common\models\PassedTest;
use yii\web\Controller;
use Yii;

class CompletedTestController extends Controller
{
    public function beforeAction($action)
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect('/site/login')->send();
        }
        return true;
    }

    public function actionIndex(){
        $tests=PassedTest::find()->where(['is_delayed'=>0])->all();
        return $this->render('index',[
           'tests'=>$tests
        ]);
    }

    public function actionGetDetails($passed_id){
        $details=PassDetail::getDetailsByPassedId($passed_id)->asArray()->all();
        return json_encode($details);
    }

}