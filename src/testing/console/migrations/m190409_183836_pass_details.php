<?php

use yii\db\Migration;

/**
 * Class m190409_183836_pass_details
 */
class m190409_183836_pass_details extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('pass_detail',[
            'id'=>$this->bigPrimaryKey(),
            'user_id'=>$this->integer(),
            'test_id'=>$this->bigInteger(),
            'question_id'=>$this->bigInteger(),
            'question_text'=>$this->string(),
            'is_right'=>$this->boolean(),
        ]);
        $this->createIndex('pass_detail-user','pass_detail','user_id');
        $this->addForeignKey(
            'test_detail-to-user',
            'pass_detail',
            'user_id',
            'user',
            'id'
        );
        $this->createIndex('pass_detail-test','pass_detail','test_id');
        $this->addForeignKey(
            'test_detail-to-test',
            'pass_detail',
            'test_id',
            'test',
            'id'
        );
        $this->createIndex('pass_detail-question','pass_detail','question_id');
        $this->addForeignKey(
            'test_detail-to-question',
            'pass_detail',
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
        $this->dropForeignKey('test_detail-to-user','pass_detail');
        $this->dropForeignKey('test_detail-to-test','pass_detail');
        $this->dropForeignKey('test_detail-to-question','pass_detail');
        $this->dropIndex('pass_detail-user','pass_detail');
        $this->dropIndex('pass_detail-test','pass_detail');
        $this->dropIndex('pass_detail-question','pass_detail');
        $this->dropTable('pass_detail');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190409_183836_pass_details cannot be reverted.\n";

        return false;
    }
    */
}
