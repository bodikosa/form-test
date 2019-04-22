<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_category}}`.
 */
class m190421_070451_create_user_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_category}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string(255)
        ]);


        $this->createIndex(
            'indx-user_category-user_id',
            'user_category',
            'user_id'
        );

        $this->addForeignKey(
            'fk-user_category-user_id',
            'user_category',
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
        $this->dropForeignKey('fk-user_category-user_id', 'user_category');
        $this->dropIndex('indx-user_category-user_id', 'user_category');
        $this->dropTable('{{%user_category}}');
    }
}
