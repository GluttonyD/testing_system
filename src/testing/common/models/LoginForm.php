<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    public $phone;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['password','username'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if($this->username) {
                if (!$user || !$user->validatePassword($this->password)) {
                    $this->addError($attribute, 'Incorrect username or password.');
                }
            }
            if($this->phone) {
                if (!$user || !$user->validateSmsPassword($this->password)) {
                    $this->addError($attribute, 'Incorrect password.');
                }
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        
        return false;
    }

    public function getPassword($phone){
        $user=User::findByPhone($phone);
        if($user){
            $pass=rand(1000, 9999);
            $user->sms_password_hash=Yii::$app->security->generatePasswordHash($pass);
            $user->save();
            $message='Your password: '.$pass;
            $curl = curl_init();
            $url = "https://smsc.ru/sys/send.php?login=aritomo&psw=deathcutegirlA1&phones=" . $this->phone . "&mes=" . $message;
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $out = curl_exec($curl);
            curl_close($curl);
            return true;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            if($this->username) {
                $this->_user = User::findByUsername($this->username);
            }
            if($this->phone){
                $this->_user = User::findByPhone($this->phone);
            }
        }

        return $this->_user;
    }
}
