<?php
/**
 * Created by PhpStorm.
 * User: Aritomo
 * Date: 15.03.2019
 * Time: 17:29
 */

namespace backend\controllers;


use backend\models\PassTestForm;
use common\models\User;
use yii\web\Controller;
use backend\models\PassedTestForm;
use common\models\PassedTest;
use common\models\Test;
use Yii;

class DelayedTestController extends Controller
{
    public function beforeAction($action)
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect('/site/login')->send();
        }
        return true;
    }

    public function actionIndex(){
        $tests=PassedTest::find()->where(['is_delayed'=>1])->all();
        return $this->render('index',[
            'tests'=>$tests
        ]);
    }

    public function actionCreate(){
        $form=new PassedTestForm();
        if($form->load(Yii::$app->request->post()) && $form->create()){
            return $this->redirect('index');
        }
        return $this->render('create',[
            'form'=>$form
        ]);
    }

    public function actionGetTest($test_id){
        $test=Test::find()->where(['id'=>$test_id])->with('questions.answers')->asArray()->one();
        return json_encode($test);
    }

    public function actionPassTest($delayed_test_id=null){
        $form=new PassTestForm($delayed_test_id);
        if($form->load(Yii::$app->request->post()) && $form->pass()){
            return $this->redirect('index');
        }
        return $this->render('pass-test',[
           'form'=>$form
        ]);
    }

    public function actionGeneratePdf($test_id,$user_id){
        $pdf = Yii::$app->pdf;
        $test=Test::find()->where(['id'=>$test_id])->with('questions.answers')->one();
        $user=User::find()->where(['id'=>$user_id])->one();
        $content = $this->renderPartial('test-pdf',['test'=>$test,'user'=>$user]);
        $pdf->content = $content;
        return $pdf->render();
    }

}