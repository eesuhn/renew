<?php

namespace App\Models;

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

use PDO;
use PDOException;

class DatabaseModel
{
    /**
     * @var PDO $connection For database connection.
     */
    private static $connection = null;

    /**
     * @var array $tables Database tables.
     */
    private static $tables = [
        'user',
        'user_lang',
        'public_lang',
        'artist_lang',
        'rec_center',
        'recyclable',
        'rec_lang',
        'order',
        'product',
        'prod_lang',
        'order_item',
        'cart'
    ];

    /**
     * @var array $sampleUsers Sample users.
     */
    private static $sampleUsers = [
        'jason_delulu@mail.com',
        'elizabeth_josh@mail.com'
    ];

    /**
     * @var array $sampleProds Sample products.
     */
    private static $sampleProd = [
        'carton_flower_pots',
        'cloth_travel_bag',
        'crocheted_flower_buds',
        'flower_glass_vase',
        'handpainted_plates',
        'hanging_heart_chimes',
        'indoor_plastic_flowerpots',
        'reusable_coffee_mugs'
    ];

    /**
     * Connect to database and return connection.
     * 
     * @return PDO|bool Returns PDO object if connection is successful, false otherwise.
     */
    public static function connect()
    {
        if (self::$connection === null) {
            require_once ROOT . '/app/config/config.php';

            try {
                self::$connection = new PDO(
                    'mysql:host=' . $dbConfig['host'] . ';dbname=' . $dbConfig['database'],
                    $dbConfig['username'],
                    $dbConfig['password']
                );
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {
                return false;
            }
        }
        return self::$connection;
    }

    /**
     * Install tables.
     * 
     * @return void
     */
    public static function installTables()
    {
        require_once ROOT . '/app/config/database.php';

        self::$connection->prepare($sql)->execute();
    }

    /**
     * Check if tables exist.
     * 
     * @return bool Returns true if tables exist, false otherwise.
     */
    public static function checkTables()
    {
        foreach (self::$tables as $table) {
            $sql = <<<SQL
                SHOW TABLES LIKE :table;
            SQL;

            $stmt = self::$connection->prepare($sql);
            $stmt->bindParam(':table', $table);
            $stmt->execute();
            $result = $stmt->fetchColumn();

            if (!$result) {
                return false;
            }
        }
        return true;
    }

    /**
     * Validate if database and tables are setup.
     * 
     * @return bool Returns true if database is setup, false otherwise.
     */
    public static function validateDbSetup()
    {
        if (self::connect()) {
            if (!self::checkTables()) {
                self::installTables();
            }
            return true;
        }
        return false;
    }

    /**
     * Execute SQL query.
     * Convert array to PDO parameters.
     * 
     * @param string $sql SQL query.
     * @param array $params (Optional) Parameters for PDO.
     * 
     * @return PDOStatement Returns PDOStatement object.
     */
    public static function exec($sql, $params = [])
    {
        $stmt = self::connect()->prepare($sql);

        if (count($params) > 0) {
            foreach ($params as $key => &$value) {
                /**
                 * Check if value is integer.
                 */
                if (is_integer($value)) {
                    $stmt->bindParam($key, $value, PDO::PARAM_INT);

                } else {
                    $stmt->bindParam($key, $value, PDO::PARAM_STR);
                }
            }
        }
        $stmt->execute();
        return $stmt;
    }

    /**
     * Check the status of the query.
     * 
     * @param string $sql SQL query.
     * @param array $params (Optional) Parameters for PDO.
     * 
     * @return bool Returns true if query was successful, false otherwise.
     */
    public static function checkExec($sql, $params = [])
    {
        try {
            self::exec($sql, $params);
            return true;

        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Check if sample users exist.
     * 
     * @return bool Returns true if sample users exist, false otherwise.
     */
    private static function checkSampleUsers()
    {
        $sql = <<<SQL
            SELECT
                `email`
            FROM
                `user`
            WHERE
                `email` = :email;
        SQL;

        foreach (self::$sampleUsers as $email) {
            $stmt = self::exec($sql, [':email' => $email]);
            $result = $stmt->fetchColumn();

            if (!$result) {
                return false;
            }
        }
        return true;
    }

    /**
     * Check if sample products exist.
     * 
     * @return bool Returns true if sample products exist, false otherwise.
     */
    private static function checkSampleProds()
    {
        $sql = <<<SQL
            SELECT
                `dir_name`
            FROM
                `product`
            WHERE
                `dir_name` = :dir_name;
        SQL;

        foreach (self::$sampleProd as $dirName) {
            $stmt = self::exec($sql, [':dir_name' => $dirName]);
            $result = $stmt->fetchColumn();

            if (!$result) {
                return false;
            }
        }
        return true;
    }

    /**
     * Install sample users and products.
     * 
     * @return void
     */
    private static function installSamples()
    {
        require_once ROOT . '/app/config/sample.php';

        self::$connection->prepare($sql)->execute();
    }

    /**
     * Validate if sample users and products are setup.
     * Setup sample users and products if they are not setup.
     * 
     * @return bool Returns true if sample setup is valid (users and products exist), false otherwise.
     */
    public static function validateSampleSetup()
    {
        if (!self::checkSampleUsers() || !self::checkSampleProds()) {
            self::installSamples();
            return false;
        }
        return true;
    }
}
