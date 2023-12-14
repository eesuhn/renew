<?php

namespace App\Models;

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

use PDO;
use App\Models\DatabaseModel;
use App\Models\ProductModel;
use App\Models\CartModel;

class OrderModel
{
    /**
     * Get total points used by user id.
     * 
     * @param int $userId
     * 
     * @return int
     */
    public static function getTotalRecPointUsedByUserId($userId)
    {
        $sql = <<<SQL
            SELECT
                SUM(rec_point_used) as total_rec_point_used
            FROM
                orders
            WHERE
                user_id = :userId
        SQL;

        $params = [
            ':userId' => $userId
        ];

        $totalRecPointUsed = DatabaseModel::exec($sql, $params)->fetch(PDO::FETCH_ASSOC)['total_rec_point_used'];

        if ($totalRecPointUsed === null) {
            $totalRecPointUsed = 0;
        }

        return $totalRecPointUsed;
    }

    /**
     * Set order.
     * 
     * @param int $userId
     * @param int $recPointUsed (Optional) Default value is 0
     * @param string $orderStatus (Optional) Default value is 'pending'
     * 
     * @return int Returns order id
     */
    public function setOrder($userId, $recPointUsed = 0, $orderStatus = 'pending')
    {
        $sql = <<<SQL
            INSERT INTO orders (
                user_id,
                order_status,
                rec_point_used
            ) VALUES (
                :userId,
                :orderStatus,
                :recPointUsed
            )
        SQL;

        $params = [
            ':userId' => $userId,
            ':orderStatus' => $orderStatus,
            ':recPointUsed' => $recPointUsed
        ];

        DatabaseModel::exec($sql, $params);
        $orderId = DatabaseModel::connect()->lastInsertId();

        return $orderId;
    }

    /**
     * Set order item.
     * 
     * @param int $orderId
     * @param int $prodId
     * @param int $quantity
     * 
     * @return void
     */
    public function setOrderItem($orderId, $prodId, $quantity)
    {
        $sql = <<<SQL
            INSERT INTO order_item (
                order_id,
                prod_id,
                quantity
            ) VALUES (
                :orderId,
                :prodId,
                :quantity
            )
        SQL;

        $params = [
            ':orderId' => $orderId,
            ':prodId' => $prodId,
            ':quantity' => $quantity
        ];

        DatabaseModel::exec($sql, $params);
    }

    /**
     * Get order total amount by cart.
     * 
     * @return int
     */
    public function getOrderTotalByCart()
    {
        $userId = UserModel::getCurUserId();

        $cm = new CartModel();
        $cart = $cm->getCartProdByUserId($userId);

        $total = 0;
        foreach ($cart as $product) {
            $total += $product['price'] * $product['quantity'];
        }

        return $total;
    }

    /**
     * Get order total amount by order id.
     * 
     * @param int $orderId
     * 
     * @return int
     */
    public function getOrderTotalByOrderId($orderId)
    {
        $sql = <<<SQL
            SELECT
                SUM(p.price * oi.quantity) as total
            FROM
                order_item oi
            INNER JOIN
                product p
            ON
                oi.prod_id = p.prod_id
            WHERE
                oi.order_id = :orderId
        SQL;

        $params = [
            ':orderId' => $orderId
        ];

        $total = DatabaseModel::exec($sql, $params)->fetch(PDO::FETCH_ASSOC)['total'];

        if ($total === null) {
            $total = 0;
        }

        return $total;
    }
}
