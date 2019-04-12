<?php
/**
 * Created by PhpStorm.
 * User: Aritomo
 * Date: 16.03.2019
 * Time: 12:42
 */

namespace backend\models;


use common\models\Answer;
use common\models\PassDetail;
use common\models\PassedTest;
use common\models\Test;
use yii\base\Model;
use yii\helpers\VarDumper;
use common\models\Question;

class PassTestForm extends Model
{
    public $test=[];

    /**
     * @var PassedTest $delayed_test
     */
    public $delayed_test;

    public function __construct($delayed_test_id)
    {
        parent::__construct();
        $this->delayed_test=PassedTest::find()->where(['id'=>$delayed_test_id])->with('test')->one();
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
             * @var PassedTest $delayed_test
             */
            $delayed_test=PassedTest::find()->where(['id'=>$this->test['delayed_test_id']])->with('test.questions.answers')->one();
            $delayed_test->is_delayed=0;
            $delayed_test->passed_at=time();
            $delayed_test->save();
            $this->checkAnswers($delayed_test);
            return true;
        }
        return false;
    }

    /**
     * @param PassedTest $delayed_test
     */
    public function checkAnswers($delayed_test){
        $delayed_test->question_count=0;
        $delayed_test->right_answers=0;
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
            $detail->user_id=$delayed_test->user_id;
            $detail->passed_id=$delayed_test->id;
            $delayed_test->question_count++;
            $question_data->answers_count++;
            if($is_right){
                $question_data->right_answers_count++;
                $delayed_test->right_answers++;
                $detail->is_right=1;
            }
            $question_data->save();
            $detail->save();
        }
        $delayed_test->result=$delayed_test->right_answers/$delayed_test->question_count;
        $delayed_test->save();
    }


}