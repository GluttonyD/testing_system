<?php

use yii\db\Migration;

/**
 * Class m190327_180952_add_user_smspass
 */
class m190327_180952_add_user_smspass extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user','sms_password_hash',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user','sms_password_hash');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190327_180952_add_user_smspass cannot be reverted.\n";

        return false;
    }
    */
}
