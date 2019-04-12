<?php

use yii\db\Migration;

/**
 * Class m190309_185026_foreign_keys
 */
class m190309_185026_foreign_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex('question-section_id', 'question', 'section_id');
        $this->createIndex('answer-question_id', 'answer', 'question_id');
        $this->addForeignKey(
            'question-to-section',
            'question',
            'section_id',
            'section',
            'id'
        );
        $this->addForeignKey(
            'answer-to-question',
            'answer',
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
            'question-to-section',
            'question'
        );
        $this->dropForeignKey(
            'answer-to-question',
            'answer'
        );
        $this->dropIndex('question-section_id', 'question');
        $this->dropIndex('answer-question_id', 'answer');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190309_185026_foreign_keys cannot be reverted.\n";

        return false;
    }
    */
}
