<?php

use yii\db\Migration;

/**
 * Class m190404_083018_insert_user
 */
class m190404_083018_insert_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%user}}', [
            'username' => 'harut',
            'auth_key' => 'LxoS_F5-1TgacOX1sQZUSCq1goKrnnbv',
            'password_hash' => '$2y$13$rmoebMBSlnsLx5YylqvnN.TZfExhLB1rxxmfFudIACghTAVDa2hwm', //123456
            'password_reset_token' => '',
            'email' => 'harut.sargsyan87@gmail.com',
            'status' => 10,
            'created_at' => 1521357799,
            'updated_at' => 1527540234,
            'verification_token' => '',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190404_083018_insert_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190404_083018_insert_user cannot be reverted.\n";

        return false;
    }
    */
}
