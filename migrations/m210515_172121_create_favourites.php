<?php

use yii\db\Migration;

/**
 * Class m210515_172121_create_favourites
 */
class m210515_172121_create_favourites extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('favourites', [
            'id' => $this->primaryKey()->defaultValue(uuid()),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210515_172121_create_favourites cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210515_172121_create_favourites cannot be reverted.\n";

        return false;
    }
    */
}
