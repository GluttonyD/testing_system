<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "section".
 *
 * @property int $id
 * @property string $name
 * @property int $created_by
 * @property int $created_at
 *
 * @property Question[] $questions
 * @property User $author
 */
class Section extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'section';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_by', 'created_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
        ];
    }

    public function deleteSection(){
        /**
         * @var Question[] $questions
         */
        $questions=Question::find()->where(['section_id'=>$this->id])->with('answers')->all();
        if($questions){
            foreach ($questions as $question){
                $question->deleteQuestion();
            }
        }
        $this->delete();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['section_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor(){
        return $this->hasOne(User::className(),['id'=>'created_by']);
    }
}
