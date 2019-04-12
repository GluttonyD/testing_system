<?php

use yii\db\Migration;

/**
 * Class m190315_140413_add_user_role
 */
class m190315_140413_add_user_role extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user','role',$this->smallInteger()->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user','role');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190315_140413_add_user_role cannot be reverted.\n";

        return false;
    }
    */
}
