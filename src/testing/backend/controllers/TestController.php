<?php
/**
 * Created by PhpStorm.
 * User: Aritomo
 * Date: 11.03.2019
 * Time: 18:35
 */

namespace backend\controllers;


use backend\models\EditTestForm;
use backend\models\PassedTestForm;
use backend\models\TestForm;
use common\models\PassedTest;
use common\models\Question;
use common\models\Test;
use yii\data\Pagination;
use yii\helpers\VarDumper;
use yii\web\Controller;
use Yii;

class TestController extends Controller
{
    public function beforeAction($action)
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect('/site/login')->send();
        }
        return true;
    }

    public function actionGetSections(){
        return json_encode(TestForm::getSections());
    }

    public function actionIndex(){
        $query=Test::find();
        $pages=new Pagination(['totalCount'=>$query->count()]);
        $tests=$query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index',[
           'tests'=>$tests,
            'pages'=>$pages
        ]);
    }

    public function actionCreate(){
        $form=new TestForm();
        if($form->load(Yii::$app->request->post()) && $form->create()){
            return $this->redirect('index');
        }
        if(Yii::$app->request->isAjax){
            return json_encode($form->errors);
        }
        return $this->render('create',[
           'form'=>$form
        ]);
    }

    public function actionDetails($id){
        /**
         * @var Test $test
         */
        $test=Test::find()->where(['id'=>$id])->one();
        $query=$test->getQuestions();
        $pages=new Pagination(['totalCount'=>$query->count()]);
        $questions=$query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('details',[
           'test'=>$test,
            'questions'=>$questions,
            'pages'=>$pages
        ]);
    }

    public function actionEdit($id){
        $form=new EditTestForm($id);
        if($form->load(Yii::$app->request->post()) && $form->edit()){
            return $this->redirect('/test/index');
        }
        return $this->render('edit',[
            'form'=>$form
        ]);
    }

    public function actionDelete($id){
        /**
         * @var Test $test
         */
        $test=Test::find()->where(['id'=>$id])->one();
        if($test){
            $test->deleteTest();
            return true;
        }
        return false;
    }


    public function actionGetQuestions($test_id){
        $test=Test::find()->where(['id'=>$test_id])->with('questions.answers')->asArray()->one();
        return json_encode($test);
    }

    public function actionGeneratePdf($test_id){
        $pdf = Yii::$app->pdf;
        $test=Test::find()->where(['id'=>$test_id])->with('questions.answers')->one();
        $content = $this->renderPartial('test-pdf',['test'=>$test]);
        $pdf->content = $content;
        return $pdf->render();
    }
}