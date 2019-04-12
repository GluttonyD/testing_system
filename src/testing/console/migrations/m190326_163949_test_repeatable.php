<?php

use yii\db\Migration;

/**
 * Class m190326_163949_test_repeatable
 */
class m190326_163949_test_repeatable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('test','repeatable',$this->boolean()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('test','repeatable');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190326_163949_test_repeatable cannot be reverted.\n";

        return false;
    }
    */
}
