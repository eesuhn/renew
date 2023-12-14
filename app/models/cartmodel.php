<?php

namespace App\Models;

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

use PDO;
use App\Models\ProductModel;
use App\Models\OrderModel;
use App\Models\UserModel;

class CartModel
{
    /**
     * Add product to cart.
     * 
     * @param int $userId
     * @param string $prodDirName
     * @param int $prodCount
     * 
     * @return bool Returns true if adding product to cart is successful.
     */
    public function addToCart($userId, $prodDirName, $prodCount)
    {
        $pm = new ProductModel;
        $product = $pm->getProdByDirName($prodDirName);

        $sql = <<<SQL
            INSERT INTO
                cart (prod_id, user_id, quantity)
            VALUES
                (:prodId, :userId, :quantity)
        SQL;

        /**
         * If product is already added to cart, update quantity.
         */
        if ($this->checkIfProdAddedToCart($userId, $prodDirName)) {
            $sql = <<<SQL
                UPDATE
                    cart
                SET
                    quantity = quantity + :quantity
                WHERE
                    prod_id = :prodId AND
                    user_id = :userId
            SQL;
        }

        $params = [
            ':prodId' => $product['prod_id'],
            ':userId' => $userId,
            ':quantity' => $prodCount
        ];

        DatabaseModel::exec($sql, $params);
        return true;
    }

    /**
     * Check if product is already added to cart.
     * 
     * @param int $userId
     * @param string $prodDirName
     * 
     * @return bool Returns true if product is already added to cart.
     */
    public function checkIfProdAddedToCart($userId, $prodDirName)
    {
        $pm = new ProductModel;
        $product = $pm->getProdByDirName($prodDirName);

        $sql = <<<SQL
            SELECT
                COUNT(*) as count
            FROM
                cart
            WHERE
                prod_id = :prodId AND
                user_id = :userId
        SQL;

        $params = [
            ':prodId' => $product['prod_id'],
            ':userId' => $userId
        ];

        $count = DatabaseModel::exec($sql, $params)->fetch(PDO::FETCH_ASSOC)['count'];

        return $count > 0;
    }

    /**
     * Get cart products by user id.
     * 
     * @param int $userId
     * 
     * @return array Returns an array of cart products.
     * 
     */
    public function getCartProdByUserId($userId)
    {
        $sql = <<<SQL
            SELECT
                u.user_id as buyer_id,
                c.prod_id,
                c.quantity,
                c.time_create,
                p.user_id as seller_id, 
                p.price,
                pl.prod_name,
                pl.description,
                pl.img_path
            FROM
                cart c
            INNER JOIN
                product p ON c.prod_id = p.prod_id
            INNER JOIN
                prod_lang pl ON p.prod_id = pl.prod_id
            INNER JOIN
                user u ON p.user_id = u.user_id
            WHERE
                c.user_id = :userId
        SQL;

        $params = [
            ':userId' => $userId
        ];

        return DatabaseModel::exec($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Clear cart by user id.
     * 
     * @param int $userId
     * 
     * @return void
     */
    public function clearCartByUserId($userId)
    {
        $sql = <<<SQL
            DELETE FROM
                cart
            WHERE
                user_id = :userId
        SQL;

        $params = [
            ':userId' => $userId
        ];

        DatabaseModel::exec($sql, $params);
    }

    /**
     * Checkout cart.
     * 
     * @param int $discount (Optional) Discount value.
     * 
     * @return void
     */
    public function checkout($discount = 0)
    {
        $userId = UserModel::getCurUserId();

        $pm = new ProductModel;

        $om = new OrderModel;
        $orderId = $om->setOrder($userId, $discount);

        foreach ($this->getCartProdByUserId($userId) as $product) {
            $om->setOrderItem($orderId, $product['prod_id'], $product['quantity']);
            $pm->redProdQty($product['prod_id'], $product['quantity']);
        }

        $this->clearCartByUserId($userId);
    }
}
