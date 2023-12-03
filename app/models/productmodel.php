<?php

namespace App\Models;

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

use PDO;
use App\Models\DatabaseModel;

class ProductModel
{
    /**
     * Add product.
     * 
     * @param string $userId
     * @param string $prodName
     * @param string $prodPrice
     * @param string $quantity
     * @param string $description
     * @param string $imgPath
     * 
     * @return bool|array Returns true if adding product is successful, array of errors otherwise
     */
    public function addProduct(
        $userId, 
        $prodName, 
        $prodPrice, 
        $quantity, 
        $description, 
        $imgPath)
    {
        $errors = $this->validateAddProd(
            $prodName, 
            $prodPrice, 
            $quantity, 
            $description
        );
        if (count($errors) > 0) {
            return $errors;
        }

        $sql = <<<SQL
            INSERT INTO 
                product (user_id, name, price, quantity)
            VALUES 
                (:userId, :prodName, :prodPrice, :quantity)
        SQL;

        $params = [
            ':userId' => $userId,
            ':prodName' => $prodName,
            ':prodPrice' => $prodPrice,
            ':quantity' => $quantity
        ];

        DatabaseModel::exec($sql, $params);

        $prodId = DatabaseModel::connect()->lastInsertId();

        /**
         * @var string $sql_lang Insert to prod_lang table.
         */
        $sql_lang = <<<SQL
            INSERT INTO 
                prod_lang (prod_id, description, img_path)
            VALUES 
                (:prodId, :description, :imgPath)
        SQL;

        $params_lang = [
            ':prodId' => $prodId,
            ':description' => $description,
            ':imgPath' => $imgPath
        ];

        DatabaseModel::exec($sql_lang, $params_lang);

        return true;
    }

    /**
     * Validate product name, price, quantity, and description 
     * from adding product.
     * 
     * @param string $prodName
     * @param string $prodPrice
     * @param string $quantity
     * @param string $description
     * 
     * @return array Returns array of errors
     */
    private function validateAddProd(
        $prodName, 
        $prodPrice, 
        $quantity, 
        $description)
    {
        $errors = [];

        if (empty($prodName)) {
            $errors['prodName'] = '*Required';
        }

        if (empty($prodPrice)) {
            $errors['prodPrice'] = '*Required';
        }

        if (empty($quantity)) {
            $errors['quantity'] = '*Required';
        }

        if (empty($description)) {
            $errors['description'] = '*Required';
        }

        if (!is_numeric($prodPrice) && !isset($errors['prodPrice'])) {
            $errors['prodPrice'] = '*Must be a number';
        }

        if (!is_numeric($quantity) && !isset($errors['quantity'])) {
            $errors['quantity'] = '*Must be a number';
        }

        return $errors;
    }
}
