<?php

use yii\db\Migration;

/**
 * Class m190309_184635_section_table
 */
class m190309_184635_section_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('section',[
           'id'=>$this->bigPrimaryKey(),
           'name'=>$this->string(),
           'created_by'=>$this->bigInteger(),
           'created_at'=>$this->bigInteger()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('section');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190309_184635_section_table cannot be reverted.\n";

        return false;
    }
    */
}
