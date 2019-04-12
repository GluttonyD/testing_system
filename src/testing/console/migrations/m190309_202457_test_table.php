<?php

use yii\db\Migration;

/**
 * Class m190309_202457_test_table
 */
class m190309_202457_test_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('test',[
            'id'=>$this->bigPrimaryKey(),
            'name'=>$this->string(),
            'created_by'=>$this->bigInteger(),
            'created_at'=>$this->bigInteger()
        ]);
        $this->createTable('test_question',[
            'id'=>$this->bigPrimaryKey(),
            'test_id'=>$this->bigInteger(),
            'question_id'=>$this->bigInteger()
        ]);
        $this->createIndex('test-question-test_id','test_question','test_id');
        $this->createIndex('test-question-question_id','test_question','question_id');
        $this->addForeignKey(
          'test-question-to-test',
          'test_question',
          'test_id',
          'test',
          'id'
        );
        $this->addForeignKey(
            'test-question-to-question',
            'test_question',
            'question_id',
            'question',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'test-question-to-test',
            'test_question'
        );
        $this->dropForeignKey(
            'test-question-to-question',
            'test_question'
        );
        $this->dropIndex('test-question-test_id','test_question');
        $this->dropIndex('test-question-question_id','test_question');
        $this->dropTable('test');
        $this->dropTable('test_question');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190309_202457_test_table cannot be reverted.\n";

        return false;
    }
    */
}
