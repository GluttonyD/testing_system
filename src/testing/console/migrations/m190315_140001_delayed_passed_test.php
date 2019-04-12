<?php

use yii\db\Migration;

/**
 * Class m190315_140001_delayed_passed_test
 */
class m190315_140001_delayed_passed_test extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('passed_test','is_delayed',$this->boolean()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('passed_test','is_delayed');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190315_140001_delayed_passed_test cannot be reverted.\n";

        return false;
    }
    */
}
