<?php
/**
 * Created by PhpStorm.
 * User: Aritomo
 * Date: 27.03.2019
 * Time: 21:18
 */

namespace frontend\models;


use common\models\User;
use yii\base\Model;
use Yii;

class GetPasswordForm extends Model
{
    public $phone;
    /**
     * @var User
     */
    protected $_user;

    public function rules()
    {
        return [
          ['phone','required'],
          ['phone','string'],
          ['phone','validatePhone']
        ];
    }

    public function validatePhone($attribute,$params){
        $this->_user=User::findByPhone($this->phone);
        if(!$this->_user){
            $this->addError($attribute,'Телефона не существует');
        }
    }

    public function getPassword(){
        if($this->validate()){
            $pass=rand(1000, 9999);
            $this->_user->sms_password_hash=Yii::$app->security->generatePasswordHash($pass);
            $this->_user->password_reset_token=(string)$pass;
            $this->_user->save();
            $message='Your password: '.$pass;
            $curl = curl_init();
            $url = "https://smsc.ru/sys/send.php?login=aritomo&psw=deathcutegirlA1&phones=" . $this->phone . "&mes=" . $message.'&cost';
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $out = curl_exec($curl);
            curl_close($curl);
            return true;
        }
        return false;
    }
}