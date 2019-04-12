<?php
/**
 * Created by PhpStorm.
 * User: Aritomo
 * Date: 18.03.2019
 * Time: 13:55
 */

namespace frontend\controllers;


use common\models\Test;
use frontend\models\PassTestForm;
use yii\web\Controller;
use Yii;
use common\models\PassedTest;

class TestController extends Controller
{
    public function beforeAction($action)
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect('/site/login')->send();
        }
        return true;
    }

    public function actionIndex(){
        $tests=Test::getAvailableTests();
        Test::getAvailableTests();
        return $this->render('index',[
            'tests'=>$tests
        ]);
    }

    public function actionPassTest($test_id=null){
        $form=new PassTestForm($test_id);
        if($form->load(Yii::$app->request->post()) && $form->pass()){
            return $this->redirect('index');
        }
        return $this->render('pass-test',[
            'form'=>$form
        ]);
    }

    public function actionPassedTestIndex(){
        $tests=PassedTest::find()->where(['is_delayed'=>0])->andWhere(['user_id'=>Yii::$app->user->getId()])->all();
        return $this->render('passed-test',[
            'tests'=>$tests
        ]);
    }
}