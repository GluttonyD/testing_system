<?php
/**
 * Created by PhpStorm.
 * User: Aritomo
 * Date: 27.03.2019
 * Time: 21:52
 */

namespace frontend\models;


use yii\base\Model;
use common\models\User;
use Yii;

class LogByPhoneForm extends Model
{
    public $phone;
    public $password;

    /**
     * @var User;
     */
    private $_user;

    public function rules()
    {
        return [
          [['phone','password'],'required'],
          [['phone','password'],'string'],
          ['password','validatePassword']
        ];
    }

    public function validatePassword($attribute,$params){
        $this->_user=User::findByPhone($this->phone);
        if(!$this->_user || $this->_user->validateSmsPassword($this->phone)){
            $this->addError($attribute,'Неправильный пароль');
        }
    }

    public function login(){
        if($this->validate()){
            Yii::$app->user->login($this->_user);
            $this->_user->sms_password_hash=null;
            $this->_user->save();
            return true;
        }
        return false;
    }
}