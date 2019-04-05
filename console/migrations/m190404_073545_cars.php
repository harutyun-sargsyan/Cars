<?php

use yii\db\Migration;

/**
 * Class m190404_073545_cars
 */
class m190404_073545_cars extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%cars}}', [
            'id' => $this->primaryKey(),
            'make' => $this->string(255)->notNull(),
            'model' => $this->string(255)->notNull(),
            'VIN' => $this->string(100)->notNull(),
            'year' => $this->integer(4)->notNull(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->insert('{{%user}}', [
            'username' => 'admin',
            'auth_key' => 'zJiLRewqGdMP2q-aL7cFewmUsDZokP7Y',
            'password_hash' => '$2y$13$I.XkJWVtbNZZLyS0GgChd.cYZNRup1YfW4fusIbHDebfSWeLkOH1q', //gHost2018!
            'password_reset_token' => 'zJiLRewqGdMP2q-aL7cFewmUsDZokP7Y',
            'email' => 'xxxharxxx@mail.ru',
            'status' => 1,
            'created_at' => 1521357799,
            'updated_at' => 1527540234,
            'verification_token' => 'zJiLRewqGdMP2q-aL7cFewmUsDZokP7Y'
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%cars}}');
    }



}
