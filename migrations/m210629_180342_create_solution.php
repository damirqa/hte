<?php

use yii\db\Migration;

/**
 * Class m210629_180342_create_solution
 */
class m210629_180342_create_solution extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('solution', [
            'id' => $this->bigPrimaryKey(),
            'id_project' => $this->integer()->notNull(),
            'id_performer' => $this->integer(),
            'date_create' => $this->date(),
            'date_change' => $this->date(),
            'status' => $this->string(),
            'files_link' => $this->text(),
            'comment' => $this->text()
        ]);

        $this->addForeignKey(
            'fk-project-solution-id',
            'solution',
            'id_project',
            'project',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-performer-solution-id',
            'solution',
            'id_performer',
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
        echo "m210629_180342_create_solution cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210629_180342_create_solution cannot be reverted.\n";

        return false;
    }
    */
}
