<?php
/**
 * Created by PhpStorm.
 * User: Aritomo
 * Date: 10.03.2019
 * Time: 20:45
 */

namespace backend\models;


use common\models\Answer;
use common\models\Section;
use common\models\Question;
use Mpdf\Tag\Q;
use yii\base\Model;
use Yii;

class QuestionForm extends Model
{
    public $section_id;
    public $text;

    public $answers=[];

    public $sections=[];

    /**
     * @var Question
     */
    private $_question;

    public function __construct($question_id=null)
    {
        parent::__construct();
        /**
         * @var Section[] $tmp
         */
        $tmp=Section::find()->all();
        foreach ($tmp as $section){
            $this->sections[$section->id]=$section->name;
        }
        if($question_id){
            $this->_question=Question::find()->where(['id'=>$question_id])->with('answers')->one();
            $this->text=$this->_question->text;
            $this->section_id=$this->_question->section_id;
        }
        else{
            $this->_question=new Question();
        }
    }

    public function rules()
    {
        return [
          [['text','section_id','answers'],'required'],
            ['text','string'],
            ['section_id','integer'],
            ['answers','safe']
        ];
    }

    public function create(){
        if($this->validate()){
            $this->_question->deleteAnswers();
            $this->_question->section_id=$this->section_id;
            $this->_question->text=$this->text;
            $this->_question->created_at=time();
            $this->_question->created_by=Yii::$app->user->getId();
            $this->_question->save();
            $this->addAnswers($this->_question->id);
            return true;
        }
        return false;
    }

    protected function addAnswers($question_id){
        foreach ($this->answers as $question_answer){
            $answer=new Answer();
            $answer->text=$question_answer['text'];
            $answer->question_id=$question_id;
            $answer->is_right=$question_answer['is_right'];
            $answer->save();
        }
    }
    public function getQuestionId(){
        if($this->_question->id){
            return $this->_question->id;
        }
        return null;
    }

    public function getSectionId(){
        if($this->_question->section_id){
            return $this->_question->section_id;
        }
        return null;
    }

    /**
     * @return Question|null
     */
    public function getQuestion(){
        if($this->_question){
            return $this->_question;
        }
        return null;
    }
}