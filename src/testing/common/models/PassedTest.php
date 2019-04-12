<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "passed_test".
 *
 * @property int $id
 * @property int $user_id
 * @property int $test_id
 * @property int $question_count
 * @property int $right_answers
 * @property double $result
 * @property int $passed_at
 * @property int $is_delayed
 *
 * @property Test $test
 * @property User $user
 */
class PassedTest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'passed_test';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'test_id', 'question_count', 'right_answers', 'passed_at', 'is_delayed'], 'integer'],
            [['result'], 'number'],
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
            'question_count' => 'Question Count',
            'right_answers' => 'Right Answers',
            'result' => 'Result',
            'passed_at' => 'Passed At',
            'is_delayed' => 'Is Delayed',
        ];
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
