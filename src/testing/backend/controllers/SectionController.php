<?php
/**
 * Created by PhpStorm.
 * User: Aritomo
 * Date: 10.03.2019
 * Time: 19:51
 */

namespace backend\controllers;


use yii\web\Controller;
use Yii;
use backend\models\SectionForm;
use common\models\Section;

class SectionController extends Controller
{

    public function beforeAction($action)
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect('/site/login')->send();
        }
        return true;
    }

    public function actionIndex(){
        $sections=Section::find()->all();
        return $this->render('index',[
            'sections'=>$sections
        ]);
    }

    public function actionCreate(){
        $form=new SectionForm();
        if($form->load(Yii::$app->request->post()) && $form->create()){
            return $this->redirect('index');
        }
        return $this->render('create',[
           'form' =>$form
        ]);
    }

    public function actionEdit($section_id){
        $form=new SectionForm($section_id);
        if($form->load(Yii::$app->request->post()) && $form->create()){
            return $this->redirect('index');
        }
        return $this->render('edit',[
            'form' =>$form
        ]);
    }

    public function actionDelete($section_id){
        /**
         * @var Section $section
         */
        $section=Section::find()->where(['id'=>$section_id])->one();
        $section->deleteSection();
    }
}