<?php

use yii\db\Migration;

/**
 * Class m190404_082820_alter_photos
 */
class m190404_082820_alter_photos extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('carsFK', '{{%photos}}', 'car_id', '{{%cars}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190404_082820_alter_photos cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190404_082820_alter_photos cannot be reverted.\n";

        return false;
    }
    */
}
