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
     * Get total discount from all orders by user id.
     * 
     * @param int $userId
     * 
     * @return int
     */
    public static function getTotalDiscountByUserId($userId)
    {
        $sql = <<<SQL
            SELECT
                SUM(discount) as total_discount
            FROM
                orders
            WHERE
                user_id = :userId
        SQL;

        $params = [
            ':userId' => $userId
        ];

        $totalDiscount = DatabaseModel::exec($sql, $params)->fetch(PDO::FETCH_ASSOC)['total_discount'];

        if ($totalDiscount === null) {
            $totalDiscount = 0;
        }

        return $totalDiscount;
    }

    /**
     * Set order.
     * 
     * @param int $userId
     * @param int $discount (Optional) Default value is 0
     * @param string $orderStatus (Optional) Default value is 'pending'
     * 
     * @return int Returns order id
     */
    public function setOrder($userId, $discount = 0, $orderStatus = 'pending')
    {
        $orderSubTotal = $this->getOrderTotalByCart();
        $orderTotal = $orderSubTotal - $discount;

        $sql = <<<SQL
            INSERT INTO orders (
                user_id,
                order_status,
                order_total,
                discount
            ) VALUES (
                :userId,
                :orderStatus,
                :orderTotal,
                :discount
            )
        SQL;

        $params = [
            ':userId' => $userId,
            ':orderStatus' => $orderStatus,
            ':orderTotal' => $orderTotal,
            ':discount' => $discount
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
     * Get order subtotal by cart.
     * 
     * @return int
     */
    public function getOrderTotalByCart()
    {
        $sql = <<<SQL
            SELECT
                SUM(p.price * c.quantity) as total
            FROM
                cart c
            INNER JOIN
                product p ON c.prod_id = p.prod_id
            WHERE
                c.user_id = :userId
        SQL;

        $params = [
            ':userId' => UserModel::getCurUserId()
        ];

        $total = DatabaseModel::exec($sql, $params)->fetch(PDO::FETCH_ASSOC)['total'];

        if ($total === null) {
            $total = 0;
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

    /**
     * Get all orders by user id.
     * 
     * @param int $userId
     * 
     * @return array Returns an array of orders
     */
    public function getAllOrderByUserId($userId)
    {
        $sql = <<<SQL
            SELECT
                o.order_id,
                o.order_status,
                o.discount,
                o.time_create,
                p.prod_id,
                o.order_total as total
            FROM
                orders o
            INNER JOIN
                order_item oi
            ON
                o.order_id = oi.order_id
            INNER JOIN
                product p
            ON
                oi.prod_id = p.prod_id
            WHERE
                o.user_id = :userId
            GROUP BY
                o.order_id
        SQL;

        $params = [
            ':userId' => $userId
        ];

        $orders = DatabaseModel::exec($sql, $params)->fetchAll(PDO::FETCH_ASSOC);

        return $orders;
    }

    /**
     * Get all orders.
     * 
     * @return array Returns an array of orders
     */
    public function getAllOrder()
    {
        $sql = <<<SQL
            SELECT
                o.order_id, 
                ul.user_name,
                o.time_create,
                o.order_total as total,
                (o.discount * 10) as discount,
                o.order_status
            FROM
                orders o
            INNER JOIN
                order_item oi ON o.order_id = oi.order_id
            INNER JOIN
                product p ON oi.prod_id = p.prod_id
            INNER JOIN
                user_lang ul ON o.user_id = ul.user_id
            GROUP BY
                o.order_id
        SQL;

        $orders = DatabaseModel::exec($sql)->fetchAll(PDO::FETCH_ASSOC);

        return $orders;
    }

    /**
     * Update order status.
     * 
     * @param int $orderId
     * @param string $orderStatus
     * 
     * @return bool Returns true if success.
     */
    public function updateOrderStatus($orderId, $orderStatus)
    {
        $sql = <<<SQL
            UPDATE
                orders
            SET
                order_status = :orderStatus
            WHERE
                order_id = :orderId
        SQL;

        $params = [
            ':orderStatus' => $orderStatus,
            ':orderId' => $orderId
        ];

        DatabaseModel::exec($sql, $params);
        return true;
    }
}
