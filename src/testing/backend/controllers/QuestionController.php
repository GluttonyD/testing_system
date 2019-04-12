<?php
/**
 * Created by PhpStorm.
 * User: Aritomo
 * Date: 10.03.2019
 * Time: 20:44
 */

namespace backend\controllers;


use backend\models\QuestionForm;
use common\models\Answer;
use common\models\Question;
use yii\web\Controller;
use Yii;

class QuestionController extends Controller
{

    public function beforeAction($action)
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect('/site/login')->send();
        }
        return true;
    }

    public function actionGetAnswers($question_id){
        $question=Question::find()->where(['id'=>$question_id])->with('answers')->asArray()->one();
        $answers=Answer::find()->where(['question_id'=>$question_id])->asArray()->all();
        return json_encode($question);
    }

    public function actionIndex(){
        $questions=Question::find()->with('answers')->all();
        return $this->render('index',[
           'questions'=>$questions
        ]);
    }

    public function actionCreate(){
        $form=new QuestionForm();
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

    public function actionDelete($question_id){
        /**
         * @var Question $question
         */
        $question=Question::find()->where(['id'=>$question_id])->one();
        $question->deleteQuestion();
    }

    public function actionEdit($question_id){
        $form=new QuestionForm($question_id);
        if($form->load(Yii::$app->request->post()) && $form->create()){
            return $this->redirect('index');
        }
        if(Yii::$app->request->isAjax){
            return json_encode($form->errors);
        }
        return $this->render('edit',[
            'form'=>$form
        ]);
    }
}