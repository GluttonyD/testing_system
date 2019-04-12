<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pass_detail".
 *
 * @property int $id
 * @property int $user_id
 * @property int $test_id
 * @property int $question_id
 * @property string $question_text
 * @property int $is_right
 * @property int $passed_id
 *
 * @property PassedTest $passed
 * @property Question $question
 * @property Test $test
 * @property User $user
 */
class PassDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pass_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'test_id', 'question_id', 'is_right', 'passed_id'], 'integer'],
            [['question_text'], 'string', 'max' => 255],
            [['passed_id'], 'exist', 'skipOnError' => true, 'targetClass' => PassedTest::className(), 'targetAttribute' => ['passed_id' => 'id']],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Question::className(), 'targetAttribute' => ['question_id' => 'id']],
            [['test_id'], 'exist', 'skipOnError' => true, 'targetClass' => Test::className(), 'targetAttribute' => ['test_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'test_id' => 'Test ID',
            'question_id' => 'Question ID',
            'question_text' => 'Question Text',
            'is_right' => 'Is Right',
            'passed_id' => 'Passed ID',
        ];
    }

    /**
     * @param $id
     * @return \yii\db\ActiveQuery
     */
    public static function getDetailsByPassedId($id){
        $details=PassDetail::find()->where(['passed_id'=>$id]);
        return $details;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPassed()
    {
        return $this->hasOne(PassedTest::className(), ['id' => 'passed_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Question::className(), ['id' => 'question_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTest()
    {
        return $this->hasOne(Test::className(), ['id' => 'test_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
