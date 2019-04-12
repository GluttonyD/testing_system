<?php

use yii\db\Migration;

/**
 * Class m190410_160135_pass_detail_delayed_id
 */
class m190410_160135_pass_detail_delayed_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('pass_detail','passed_id',$this->bigInteger());
        $this->createIndex('pass_detail-passed_test','pass_detail','passed_id');
        $this->addForeignKey(
            'test_detail-to-passed_test',
            'pass_detail',
            'passed_id',
            'passed_test',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('test_detail-to-passed_test','pass_detail');
        $this->dropIndex('test_detail-to-passed_test','pass_detail');
        $this->dropColumn('pass_detail','passed_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190410_160135_pass_detail_delayed_id cannot be reverted.\n";

        return false;
    }
    */
}
