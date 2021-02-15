<?php

use yii\db\Migration;

/**
 * Class m210119_070158_create_profile
 */
class m210119_070158_create_profile extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('profile', [
            'id' => $this->primaryKey(),
            'surname' => $this->string(),
            'name' => $this->string(),
            'email' => $this->string(),
            'gender' => $this->string()->defaultValue("Мужской"),
            'birthday' => $this->date(),
            'telephone' => $this->string(),
            'site' => $this->string(),
            'role' => $this->string(),
            'company' => $this->string(),
            'about' => $this->text(),
            'photo_link' => $this->text(),
            'city' => $this->string(),
        ]);

        $this->addForeignKey(
            'fk-profile-id-user',
            'profile',
            'id',
            'user',
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
        echo "m210119_070158_create_profile cannot be reverted.\n";

        return false;
    }
}
