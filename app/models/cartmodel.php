<?php

namespace App\Models;

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

use App\Models\ProductModel;

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

        $params = [
            ':prodId' => $product['prod_id'],
            ':userId' => $userId,
            ':quantity' => $prodCount
        ];

        DatabaseModel::exec($sql, $params);
        return true;
    }
}
