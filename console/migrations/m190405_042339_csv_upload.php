<?php

use yii\db\Migration;

/**
 * Class m190405_042339_csv_upload
 */
class m190405_042339_csv_upload extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

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

        $this->createTable('{{%csv_upload}}', [
            'id' => $this->primaryKey(),
            'csv' => $this->string(255)->notNull(),

        ], $tableOptions);


    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190405_042339_csv_upload cannot be reverted.\n";

        return false;
    }
    */
}
