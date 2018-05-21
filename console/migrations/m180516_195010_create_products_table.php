<?php
use console\migrations\Migration;

/**
 * Handles the creation of table `products`.
 */
class m180516_195010_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'description' => $this->string(),
            'price' => $this->integer(),
            'photo' => $this->string(),
            'quantity' => $this->integer(),
            'category_id' => $this->integer()->notNull(),
        ], $this->tableOptions);

        $this->addForeignKey('product_category_id', '{{%products}}', 'category_id', '{{%categories}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('product_category_id', '{{%products}}');
        $this->dropTable('{{%products}}');
    }
}
