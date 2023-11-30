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
        'rating',
        'cart'
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
     * Add table to database and tables array.
     * 
     * @param string $tableName Add to tables array.
     * @param string $sql SQL attributes for table.
     * 
     * @return void|Exception Returns Exception if table already exists.
     * 
     * @deprecated Lack of security since bindParam is not used.
     */
    public static function addTable($tableName, $sql)
    {
        if (array_key_exists($tableName, self::$tables)) {
            throw new \Exception('Table already exists');
        }
        self::$tables[] = $tableName;

        $sql = <<<SQL
            CREATE TABLE IF NOT EXISTS `$tableName` (
                $sql
            );
        SQL;

        self::$connection->prepare($sql)->execute();
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
                $stmt->bindParam($key, $value);
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
}
