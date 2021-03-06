<?php

use yii\db\Migration;

/**
 * Class m210219_125451_create_offer
 */
class m210219_125451_create_offer extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('offer', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer(),
            'performer_id' => $this->integer(),
            'bid' => $this->double(),
            'date' => $this->date(),
            'scheduled_time_performer' => $this->date(),
            'status' => $this->string(),
            'text' => $this->string(),
        ]);

        $this->addForeignKey(
            'fk-project',
            'offer',
            'project_id',
            'project',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-performer',
            'offer',
            'performer_id',
            'profile',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210219_125451_create_offer cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210219_125451_create_offer cannot be reverted.\n";

        return false;
    }
    */
}
