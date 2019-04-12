<?php
/**
 * Created by PhpStorm.
 * User: Aritomo
 * Date: 15.03.2019
 * Time: 17:03
 */

namespace backend\models;


use common\models\PassedTest;
use common\models\Test;
use common\models\User;
use yii\base\Model;
use Yii;

class PassedTestForm extends Model
{
    public $user_id;
    public $test_id;

    public $users;
    public $tests;

    public function __construct(array $config = [])
    {
        parent::__construct($config);
        /**
         * @var User[] $users
         * @var Test[] $tests
         */
        $users=User::find()->where(['role'=>1])->all();
        $tests=Test::find()->all();
        foreach ($users as $user){
            $this->users[$user->id]=$user->username;
        }
        foreach ($tests as $test){
            $this->tests[$test->id]=$test->name;
        }
    }

    public function rules()
    {
        return [
            [['user_id','test_id'],'integer'],
            [['user_id','test_id'],'required'],
        ];
    }

    public function create(){
        if($this->validate()){
            $passed_test=new PassedTest();
            $passed_test->user_id=$this->user_id;
            $passed_test->test_id=$this->test_id;
            $passed_test->is_delayed=1;
            $passed_test->save();
            return true;
        }
        return false;
    }
}