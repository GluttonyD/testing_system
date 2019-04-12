<?php
/**
 * Created by PhpStorm.
 * User: Aritomo
 * Date: 16.03.2019
 * Time: 12:42
 */

namespace frontend\models;


use common\models\Answer;
use common\models\PassedTest;
use common\models\Question;
use common\models\Test;
use yii\base\Model;
use Yii;
use common\models\PassDetail;

class PassTestForm extends Model
{
    public $test=[];

    /**
     * @var Test $test_questions
     */
    public $test_questions;

    public function __construct($test_id)
    {
        parent::__construct();
        /**
         * @var PassedTest[] $tests
         */
        $this->test_questions=Test::find()->where(['id'=>$test_id])->with('questions')->one();
    }

    public function rules()
    {
        return [
          ['test','required'],
        ];
    }

    public function pass(){
        if($this->validate()){
            /**
             * @var PassedTest $test_result
             */
            $test_result=new PassedTest();
            $test_result->test_id=$this->test['id'];
            $test_result->user_id=Yii::$app->user->getId();
            $test_result->is_delayed=0;
            $test_result->passed_at=time();
            $test_result->save();
            $this->checkAnswers($test_result);
            return true;
        }
        return false;
    }

    /**
     * @param PassedTest $test_result
     */
    public function checkAnswers($test_result){
        $test_result->question_count=0;
        $test_result->right_answers=0;
        foreach ($this->test['questions'] as $id =>$question){
            $is_right=1;
            /**
             * @var Question $question_data;
             */
            $question_data=Question::find()->where(['id'=>$id])->one();
            foreach ($question['answers'] as $answer_id => $answer){
                /**
                 * @var Answer $question_answer
                 */
                $question_answer=Answer::find()->where(['id'=>$answer_id])->one();
                if(!$question_answer->is_right==$answer['is_right']){
                    $is_right=0;
                    break;
                }
            }
            $detail=new PassDetail();
            $detail->test_id=$this->test['id'];
            $detail->question_text=$question['text'];
            $detail->question_id=$id;
            $detail->user_id=$test_result->user_id;
            $detail->passed_id=$test_result->id;
            $test_result->question_count++;
            $question_data->answers_count++;
            if($is_right){
                $detail->is_right=1;
                $test_result->right_answers++;
                $question_data->right_answers_count++;
            }
            $detail->save();
            $question_data->save();
        }
        $test_result->result=$test_result->right_answers/$test_result->question_count;
        $test_result->save();
    }


}