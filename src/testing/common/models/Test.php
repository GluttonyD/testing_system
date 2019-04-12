<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "test".
 *
 * @property int $id
 * @property string $name
 * @property int $created_by
 * @property int $created_at
 * @property int $repeatable
 *
 * @property TestQuestion[] $testQuestions
 * @property Question[] $questions
 * @property User $author
 */
class Test extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'test';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_by', 'created_at','repeatable'], 'integer'],
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

    public static function getAvailableTests(){
        $passed_tests=PassedTest::find()->where(['user_id'=>Yii::$app->user->getId()])->select(['test_id'])->all();
        $tmp=[];
        foreach ($passed_tests as $passed_test){
            array_push($tmp,$passed_test->test_id);
        }
        if($tmp) {
            $tests = Test::find()->where(['not in', 'id', $tmp])->orWhere(['repeatable' => 1])->all();
        }
        else{
            $tests=Test::find()->all();
        }
        return $tests;
    }


    public function deleteTest(){
        $questions_list=TestQuestion::find()->where(['test_id'=>$this->id])->all();
        $passed_tests=PassedTest::find()->where(['test_id'=>$this->id])->all();
        $passed_details=PassDetail::find()->where(['test_id'=>$this->id])->all();
        if($passed_details){
            foreach ($passed_details as $link){
                $link->delete();
            }
        }
        if($questions_list){
            foreach ($questions_list as $link){
                $link->delete();
            }
        }
        if($passed_tests){
            foreach ($passed_tests as $link){
                $link->delete();
            }
        }
        $this->delete();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestQuestions()
    {
        return $this->hasMany(TestQuestion::className(), ['test_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions(){
        return $this->hasMany(Question::className(),['id'=>'question_id'])->via('testQuestions');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor(){
        return $this->hasOne(User::className(),['id'=>'created_by']);
    }
}
