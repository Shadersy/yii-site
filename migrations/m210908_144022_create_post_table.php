<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m210908_144022_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'user_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-post-user_id}}',
            '{{%post}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-post-user_id}}',
            '{{%post}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-post-user_id}}',
            '{{%post}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-post-user_id}}',
            '{{%post}}'
        );

        $this->dropTable('{{%post}}');
    }
}
