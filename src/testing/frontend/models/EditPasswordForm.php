<?php
/**
 * Created by PhpStorm.
 * User: Aritomo
 * Date: 09.04.2019
 * Time: 20:32
 */

namespace frontend\models;

use Yii;
use common\models\User;
use yii\base\Model;

class EditPasswordForm extends Model
{
    public $old_password;
    public $new_password;

    /**
     * @var User
     */
    private $_user;

    public function rules()
    {
        return [
            [['old_password','new_password'],'required'],
            [['old_password','new_password'],'string'],
            ['old_password','validatePassword']
        ];
    }

    public function validatePassword($attribute,$params){
        $this->_user=Yii::$app->user->getIdentity();
        if(!Yii::$app->security->validatePassword($this->old_password,$this->_user->password_hash)){
            $this->addError($attribute,'Неправильно введен старый пароль');
        }
    }

    public function edit(){
        if($this->validate()){
            $this->_user->password_hash=Yii::$app->security->generatePasswordHash($this->new_password);
            $this->_user->save();
            return true;
        }
        return false;
    }
}