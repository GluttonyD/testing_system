<?php

use yii\db\Migration;

/**
 * Class m190312_202631_passed_test_table
 */
class m190312_202631_passed_test_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('passed_test',[
            'id'=>$this->bigPrimaryKey(),
            'user_id'=>$this->integer(),
            'test_id'=>$this->bigInteger(),
            'question_count'=>$this->integer(),
            'right_answers'=>$this->integer(),
            'result'=>$this->double(),
            'passed_at'=>$this->bigInteger(),
        ]);
        $this->createIndex('passed_test-test','passed_test','test_id');
        $this->addForeignKey(
            'passed_test-to-test',
            'passed_test',
            'test_id',
            'test',
            'id'
            );
        $this->createIndex('passed_test-user','passed_test','user_id');
        $this->addForeignKey(
            'passed_test-to-user',
            'passed_test',
            'user_id',
            'user',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('passed_test-to-test','passed_test');
        $this->dropForeignKey('passed_test-to-user','passed_test');
        $this->dropIndex('passed_test-test','passed_test');
        $this->dropIndex('passed_test-user','passed_test');
        $this->dropTable('passed_test');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190312_202631_passed_test_table cannot be reverted.\n";

        return false;
    }
    */
}
