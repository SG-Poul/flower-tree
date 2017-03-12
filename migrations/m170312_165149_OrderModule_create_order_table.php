<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `products`
 */
class m170312_165149_OrderModule_create_order_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'quantity' => $this->integer(),
            'time' => $this->integer(),
            'status' => $this->integer(),
            'order_No' => $this->string(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-order-user_id',
            'order',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-order-user_id',
            'order',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `product_id`
        $this->createIndex(
            'idx-order-product_id',
            'order',
            'product_id'
        );

        // add foreign key for table `products`
        $this->addForeignKey(
            'fk-order-product_id',
            'order',
            'product_id',
            'products',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-order-user_id',
            'order'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-order-user_id',
            'order'
        );

        // drops foreign key for table `products`
        $this->dropForeignKey(
            'fk-order-product_id',
            'order'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-order-product_id',
            'order'
        );

        $this->dropTable('order');
    }
}
