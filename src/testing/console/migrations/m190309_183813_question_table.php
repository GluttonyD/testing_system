<?php

use yii\db\Migration;

/**
 * Class m190309_183813_question_table
 */
class m190309_183813_question_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('question',[
           'id'=>$this->bigPrimaryKey(),
            'section_id'=>$this->bigInteger(),
            'text'=>$this->string(),
            'answers_count'=>$this->bigInteger(),
            'right_answers_count'=>$this->bigInteger(),
            'created_by'=>$this->bigInteger(),
            'created_at'=>$this->bigInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('question');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190309_183813_question_table cannot be reverted.\n";

        return false;
    }
    */
}
