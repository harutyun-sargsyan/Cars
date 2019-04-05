<?php

use yii\db\Migration;

/**
 * Class m190404_075210_photos
 */
class m190404_075210_photos extends Migration
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

        $this->createTable('{{%photos}}', [
            'id' => $this->primaryKey(),
            'car_id' => $this->integer()->notNull(),
            'photo' => $this->string(255)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);


    }

    public function down()
    {
        $this->dropTable('{{%photos}}');
    }

}
