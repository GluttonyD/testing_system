<?php
/**
 * Created by PhpStorm.
 * User: Aritomo
 * Date: 09.04.2019
 * Time: 20:09
 */

namespace frontend\models;


use common\models\User;
use yii\base\Model;
use Yii;

class ProfileForm extends Model
{

    public $username;
    public $email;
    public $phone;

    /**
     * @var User
     */
    private $_user;

    public function rules()
    {
        return [
            ['username','required'],
            ['email','email'],
            ['phone','string'],
        ];
    }

    public function __construct(array $config = [])
    {
        parent::__construct($config);

        $this->_user=Yii::$app->user->getIdentity();
        $this->phone=$this->_user->phone;
        $this->email=$this->_user->email;
        $this->username=$this->_user->username;
    }

    public function edit(){
        if($this->validate()){
            $this->_user->username=$this->username;
            $this->_user->email=$this->email;
            $this->_user->phone=$this->phone;
            $this->_user->save();
            return true;
        }
        return false;
    }
}