<?php
/**
 * Created by PhpStorm.
 * User: Aritomo
 * Date: 02.04.2019
 * Time: 17:48
 */

namespace backend\controllers;


use backend\models\ExcelParseForm;
use yii\web\Controller;
use Yii;
use yii\web\UploadedFile;

class UserController extends Controller
{
    public function beforeAction($action)
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect('/site/login')->send();
        }
        return true;
    }

    public function actionAddUserFromExcel(){
        $form=new ExcelParseForm();
        if(Yii::$app->request->isPost){
            $form->excel= UploadedFile::getInstance($form, 'excel');
            if($form->parse()){
                return 'success';
            }
        }
        return $this->render('user-parse',[
           'form'=>$form
        ]);
    }
}