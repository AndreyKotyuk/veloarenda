<?php

use yii\db\Migration;

/**
 * Class m180520_195007_add_image_to_category_table
 */
class m180520_195007_add_image_to_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%categories}}', 'image', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%categories}}', 'image');
    }
}
