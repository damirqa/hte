<?php

use yii\db\Migration;

/**
 * Class m210219_125451_offer
 */
class m210219_125451_offer extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('offer', [
            'id' => $this->primaryKey(),
            'id_project' => $this->integer(),
            'performer_id' => $this->integer(),
            'bid' => $this->double(),
            'date' => $this->date(),
            'scheduled_time_performer' => $this->date(),
            'text' => $this->string(),
        ]);

        $this->addForeignKey(
            'fk-project',
            'offer',
            'id_project',
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
            'UPDATE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210219_125451_offer cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210219_125451_offer cannot be reverted.\n";

        return false;
    }
    */
}
