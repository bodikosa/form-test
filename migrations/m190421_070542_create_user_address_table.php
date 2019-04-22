<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_address}}`.
 */
class m190421_070542_create_user_address_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_address}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'country' => $this->string(255),
            'city' => $this->string(255),
            'address' => $this->string(255),
        ]);

        $this->createIndex(
            'indx-user_address-user_id',
            'user_address',
            'user_id'
        );

        $this->addForeignKey(
            'fk-user_address-user_id',
            'user_address',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-user_address-user_id', 'user_address');
        $this->dropIndex('indx-user_address-user_id', 'user_address');
        $this->dropTable('{{%user_address}}');
    }
}
