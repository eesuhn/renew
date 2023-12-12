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
     * @param string $image
     * 
     * @return bool|array Returns true if adding product is successful, array of errors otherwise
     */
    public function addProduct(
        $userId, 
        $prodName, 
        $prodPrice, 
        $quantity, 
        $description, 
        $image)
    {
        $errors = $this->validateAddProd(
            $prodName, 
            $prodPrice, 
            $quantity, 
            $description,
            $image
        );
        if (count($errors) > 0) {
            return $errors;
        }

        $dirName = $this->getUniqueDirName($prodName);

        $sql = <<<SQL
            INSERT INTO 
                product (user_id, dir_name, price, quantity)
            VALUES 
                (:userId, :dirName, :prodPrice, :quantity)
        SQL;

        $params = [
            ':userId' => $userId,
            ':dirName' => $dirName,
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
                prod_lang (prod_id, prod_name, description, img_path)
            VALUES 
                (:prodId, :prodName, :description, :imgPath)
        SQL;

        $params_lang = [
            ':prodId' => $prodId,
            ':prodName' => $prodName,
            ':description' => $description,
            ':imgPath' => $image['fileName']
        ];

        DatabaseModel::exec($sql_lang, $params_lang);

        return true;
    }

    /**
     * Get unique directory name for product.
     * 
     * @param string $prodName
     * 
     * @return string Returns unique directory name
     */
    private function getUniqueDirName($prodName)
    {
        $prodName = preg_replace('/\s+/', '_', $prodName);
        $randName = getRand($prodName);

        while ($this->verifyUniqueDirName($randName)) {
            $randName = getRand($prodName);
        }

        return $randName;
    }

    /**
     * Verify if directory name is unique.
     * 
     * @param string $dirName
     * 
     * @return bool Returns true if directory name is unique, false otherwise
     */
    private function verifyUniqueDirName($dirName)
    {
        $sql = <<<SQL
            SELECT
                dir_name
            FROM
                product
            WHERE
                dir_name = :dirName
        SQL;

        $params = [
            ':dirName' => $dirName
        ];

        return DatabaseModel::exec($sql, $params)->rowCount() > 0;
    }

    /**
     * Validate product name, price, quantity, and description 
     * from adding product.
     * 
     * @param string $prodName
     * @param string $prodPrice
     * @param string $quantity
     * @param string $description
     * @param string $image
     * 
     * @return array Returns array of errors
     */
    private function validateAddProd(
        $prodName, 
        $prodPrice, 
        $quantity, 
        $description,
        $image)
    {
        $errors = [];

        if (empty($prodName)) {
            $errors['prodName'] = '*Required';
        }

        if (empty($prodPrice)) {
            $errors['prodPrice'] = '*Required';
        }

        if (empty($quantity)) {
            $errors['prodQty'] = '*Required';
        }

        if (empty($description)) {
            $errors['prodDesc'] = '*Required';
        }

        if (!is_numeric($prodPrice) && !isset($errors['prodPrice'])) {
            $errors['prodPrice'] = '*Must be a number';
        }

        if (!is_numeric($quantity) && !isset($errors['prodQty'])) {
            $errors['prodQty'] = '*Must be a number';
        }

        if (isset($image['error'])) {
            $errors['prodImg'] = $image['error'];
        }

        return $errors;
    }

    /**
     * Get product by product id.
     * 
     * @param string $prodId
     * 
     * @return array|bool Returns array of product if product exists, false otherwise
     */
    public function getProdById($prodId)
    {
        $sql = <<<SQL
            SELECT
                p.*, pl.*
            FROM
                product p
            INNER JOIN
                prod_lang pl ON p.prod_id = pl.prod_id
            WHERE
                p.prod_id = :prodId
        SQL;

        $params = [
            ':prodId' => $prodId
        ];

        return DatabaseModel::exec($sql, $params)->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get product by user id.
     * 
     * @param string $userId
     * 
     * @return array Returns array of product
     */
    public function getProdByUserId($userId)
    {
        $sql = <<<SQL
            SELECT
                p.*, pl.*
            FROM
                product p
            INNER JOIN
                prod_lang pl ON p.prod_id = pl.prod_id
            WHERE
                p.user_id = :userId
        SQL;

        $params = [
            ':userId' => $userId
        ];

        return DatabaseModel::exec($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get all product in descending order.
     * 
     * @return array Returns array of product
     */
    public function getAllProdDesc()
    {
        $sql = <<<SQL
            SELECT
                prod_id
            FROM
                product
            ORDER BY
                time_create DESC
        SQL;

        $arrId = DatabaseModel::exec($sql)->fetchAll(PDO::FETCH_COLUMN);

        $arr = [];
        foreach ($arrId as $prodId) {
            $arr[] = $this->getProdById($prodId);
        }

        return $arr;
    }

    /**
     * Get product by directory name.
     * 
     * @param string $dirName
     * 
     * @return array Returns array of product
     */
    public function getProdByDirName($dirName)
    {
        $sql = <<<SQL
            SELECT
                prod_id
            FROM
                product
            WHERE
                dir_name = :dirName
        SQL;

        $params = [
            ':dirName' => $dirName
        ];

        $prodId = DatabaseModel::exec($sql, $params)->fetch(PDO::FETCH_COLUMN);
        $prodArr = $this->getProdById($prodId);

        return $prodArr;
    }
}
