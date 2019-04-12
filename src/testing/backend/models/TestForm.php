<?php
/**
 * Created by PhpStorm.
 * User: Aritomo
 * Date: 12.03.2019
 * Time: 16:20
 */

namespace backend\models;


use common\models\Question;
use common\models\Section;
use common\models\Test;
use common\models\TestQuestion;
use yii\base\Model;
use Yii;

class TestForm extends Model
{
    public $name;
    public $repeatable;
    public $questions=[];

    public $sections;

    public function __construct(array $config = [])
    {
        parent::__construct($config);
        /**
         * @var Section[] $tmp
         */
        $tmp=Section::find()->all();
        foreach ($tmp as $section){
            $this->sections[$section->id]=$section->name;
        }
    }

    public function rules()
    {
        return [
            [['questions','name','repeatable'],'required'],
            ['name','string'],
            ['questions','validateQuestions']
        ];
    }

    public function validateQuestions($attribute,$params){
        foreach ($this->questions as $question){
            $count=Question::find()->where(['section_id'=>$question['section_id']])->count();
            if($count<$question['count']){
                $this->addError($attribute,'Нет необходимого количества вопросов в одном из разделов');
            }
        }
    }

    public function create(){
        if($this->validate()) {
            $test=new Test();
            $test->name=$this->name;
            $test->created_by=Yii::$app->user->getId();
            $test->created_at=time();
            $test->repeatable=(integer)$this->repeatable;
            Yii::debug($this->repeatable);
            $test->save();
            $this->generateTest($test->id);
            return true;
        }
        return false;
    }

    protected function generateTest($test_id){
        foreach ($this->questions as $question){
            /**
             * @var Question[] $query
             */
            $query=Question::find()->where(['section_id'=>$question['section_id']])->orderBy('RAND()')->limit($question['count'])->all();
            foreach ($query as $element){
                $test_question=new TestQuestion();
                $test_question->test_id=$test_id;
                $test_question->question_id=$element->id;
                $test_question->save();
            }
        }
    }

    public static function getSections(){
        /**
         * @var Section[] $tmp
         */
        $response=[];
        $tmp=Section::find()->all();
        $i=0;
        foreach ($tmp as $section){
            $response[$i]['id']=$section->id;
            $response[$i]['name']=$section->name;
            $i++;
        }
        return $response;
    }

    public static function generatePdf($test_id){
        $test=Test::find()->where(['id'=>$test_id])->with('questions.answers')->one();
    }
}