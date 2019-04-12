<?php
/**
 * Created by PhpStorm.
 * User: Aritomo
 * Date: 12.04.2019
 * Time: 18:25
 */

namespace backend\models;


use common\models\Question;
use common\models\Test;
use common\models\TestQuestion;
use yii\base\Model;

class EditTestForm extends Model
{
    public $name;
    public $question_list;

    /**
     * @var Question[]
     */
    public $questions;

    /**
     * @var Test
     */
    private $test;

    public function rules()
    {
        return [
            [['name','question_list'],'required'],
            ['name','string'],
            ['questions','safe'],
        ];
    }

    public function __construct($test_id)
    {
        parent::__construct();
        $this->test=Test::find()->where(['id'=>$test_id])->with('questions')->one();
        $this->name=$this->test->name;
        $this->questions=Question::find()->all();
    }

    public function edit(){
        if($this->validate()){
            \Yii::debug($this);
            $this->test->name=$this->name;
            $this->test->deleteQuestionLinks();
            $this->test->save();
            foreach ($this->question_list as $question){
                /**
                 * @var TestQuestion $link
                 */
                $link=new TestQuestion();
                $link->test_id=$this->test->id;
                $link->question_id=$question;
                $link->save();
            }
            return true;
        }
        return false;
    }

    /**
     * @return Test
     */
    public function getTest(){
        return $this->test;
    }
}