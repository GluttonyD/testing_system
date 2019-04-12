<?php
/**
 * Created by PhpStorm.
 * User: Aritomo
 * Date: 02.04.2019
 * Time: 19:31
 */

namespace frontend\controllers;

use common\models\User;
use frontend\models\EditPasswordForm;
use frontend\models\ProfileForm;
use Yii;
use yii\web\Controller;


class ProfileController extends Controller
{
    public function beforeAction($action)
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect('/site/login')->send();
        }
        return true;
    }

    public function actionProfile(){
        /**
         * @var User $user
         */
        $user=Yii::$app->user->getIdentity();
        return $this->render('profile',[
           'user'=>$user
        ]);
    }

    public function actionEdit(){
        $form=new ProfileForm();
        if($form->load(Yii::$app->request->post()) && $form->edit()){
            return $this->redirect('/profile/profile');
        }
        return $this->render('edit',[
            'form'=>$form
        ]);
    }

    public function actionEditPassword(){
        $form=new EditPasswordForm();
        if($form->load(Yii::$app->request->post()) && $form->edit()){
            return $this->redirect('/profile/profile');
        }
        return $this->render('password-edit',[
            'form'=>$form
        ]);
    }
}