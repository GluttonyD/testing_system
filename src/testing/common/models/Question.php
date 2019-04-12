<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property int $id
 * @property int $section_id
 * @property string $text
 * @property int $answers_count
 * @property int $right_answers_count
 * @property int $created_by
 * @property int $created_at
 *
 * @property Answer[] $answers
 * @property Section $section
 * @property TestQuestion[] $testQuestions
 * @property User $author
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['section_id', 'answers_count', 'right_answers_count', 'created_by', 'created_at'], 'integer'],
            [['text'], 'string', 'max' => 255],
            [['section_id'], 'exist', 'skipOnError' => true, 'targetClass' => Section::className(), 'targetAttribute' => ['section_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'section_id' => 'Section ID',
            'text' => 'Text',
            'answers_count' => 'Answers Count',
            'right_answers_count' => 'Right Answers Count',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
        ];
    }

    public function deleteQuestion(){
        /**
         * @var Answer[] $answers
         * @var TestQuestion[] $in_test
         */
        $answers=Answer::find()->where(['question_id'=>$this->id])->all();
        $in_test=TestQuestion::find()->where(['question_id'=>$this->id])->all();
        if($answers) {
            foreach ($answers as $answer) {
                $answer->delete();
            }
        }
        if($in_test){
            foreach ($in_test as $element){
                $element->delete();
            }
        }
        $this->delete();
    }

    public function deleteAnswers(){
        if($this->answers) {
            foreach ($this->answers as $answer) {
                $answer->delete();
            }
        }
    }

    public function getAnswersCount(){
        return $this->getAnswers()->count();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answer::className(), ['question_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(Section::className(), ['id' => 'section_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestQuestions()
    {
        return $this->hasMany(TestQuestion::className(), ['question_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor(){
        return $this->hasOne(User::className(),['id'=>'created_by']);
    }
}
