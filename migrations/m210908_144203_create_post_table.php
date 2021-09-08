<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post}}`.
 */
class m210908_144203_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'email' => $this->string()->notNull(),
            'password' => $this->string(),
            'auth_key' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%post}}');
    }
}
