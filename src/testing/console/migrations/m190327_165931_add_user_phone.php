<?php

use yii\db\Migration;

/**
 * Class m190327_165931_add_user_phone
 */
class m190327_165931_add_user_phone extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user','phone',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user','phone');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190327_165931_add_user_phone cannot be reverted.\n";

        return false;
    }
    */
}
