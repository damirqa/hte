<?php

use yii\db\Migration;

/**
 * Class m210208_065326_create_project
 */
class m210208_065326_create_project extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('project', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'type' => $this->string()->notNull(),
            'annotation' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'date'=> $this->date(),
            'price' => $this->double(),
            'customer_id' => $this->integer(),
            'performer_id' => $this->integer(),
            'task_status' => $this->string(),
            'on_time' => $this->boolean(),
            'planned_execution_time' => $this->date(),
            'actual_execution_time' => $this->date(),
            'urgently' => $this->boolean()
        ]);

        $this->addForeignKey(
            'fk-customer-id',
            'project',
            'customer_id',
            'profile',
            'id',
            'NO ACTION',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210208_065326_create_project cannot be reverted.\n";

        return false;
    }
}
