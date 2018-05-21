<?php

use common\models\User;
use yii\db\Migration;

/**
 * Class m180514_183935_add_role_to_user_table
 */
class m180514_183935_add_role_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'role', $this->smallInteger());

        $this->insert('{{%user}}', [
            'username' => 'andreikotuk',
            'email' => 'andreikotuk1@gmail.com',
            'password_hash' => '$2y$10$AAsOH9legGnDC582FKzff.4yJixLfVz3QTgUbM12w/AX7fPPO2odG',
            'auth_key' => 'aawq64JLQjm85YUCBnlmdLq9QTjxEZ06',
            'confirmed_at' => time(),
            'created_at' => time(),
            'updated_at' => time(),
            'role' => User::ROLE_ADMIN
        ]);

        $user = User::findOne(['role' => User::ROLE_ADMIN]);
        $this->insert('{{%profile}}', ['user_id' => $user->id, 'name' => 'Andrei']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'role');
    }
}
