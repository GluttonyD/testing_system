<?php

use yii\db\Migration;

/**
 * Class m190309_184833_answer_table
 */
class m190309_184833_answer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('answer',[
           'id'=>$this->bigPrimaryKey(),
           'question_id'=>$this->bigInteger(),
           'text'=>$this->string(),
           'is_right'=>$this->boolean(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('answer');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190309_184833_answer_table cannot be reverted.\n";

        return false;
    }
    */
}
