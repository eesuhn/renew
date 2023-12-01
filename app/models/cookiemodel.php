<?php

namespace App\Models;

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

use App\Models\DatabaseModel;

class CookieModel
{
    /**
     * Cookie expiry duration in seconds.
     * 30 days.
     */
    private static $expiryDuration = 60 * 60 * 24 * 30;
    
    /**
     * Set local cookie.
     * 
     * @param string $cookie
     * @param bool $stayLogin Set cookie expiry to 0 if false
     * 
     * @return void
     */
    private static function setLocalCookie($cookie, $stayLogin)
    {
        $expiry = time() + self::$expiryDuration;

        /**
         * If user opts to not stay logged in, set cookie expiry to 0.
         */
        if (!$stayLogin) {
            $expiry = 0;
        }
        setcookie('renew_user', $cookie, $expiry, '/renew/');
    }

    /**
     * Delete local cookie.
     * 
     * @return void
     */
    private static function deleteLocalCookie()
    {
        $expiry = time() - self::$expiryDuration;
        setcookie('renew_user', '', $expiry, '/renew/');
    }
    
    /**
     * Get random token.
     * 
     * @param int $length (Optional)
     * 
     * @return string
     */
    private static function getRandToken($length = 32)
    {
        return bin2hex(random_bytes($length));
    }

    /**
     * Get database cookie.
     * 
     * @param int $id
     * 
     * @return string|bool Returns cookie if exists, false otherwise
     */
    private static function getDbCookie($id)
    {
        $sql = <<<SQL
            SELECT cookie FROM user WHERE user_id = :id LIMIT 1
        SQL;

        $params = [
            ':id' => $id
        ];

        return DatabaseModel::exec($sql, $params)->fetchColumn();
    }
    
    /**
     * Update database cookie.
     * 
     * @param int $id
     * @param string $cookie (Optional)
     * 
     * @return string Returns updated cookie
     */
    private static function setDbCookie($id, $cookie = '')
    {
        if (empty($cookie)) {
            $cookie = self::getRandToken();
        }

        $sql = <<<SQL
            UPDATE user SET cookie = :cookie WHERE user_id = :id
        SQL;

        $params = [
            ':cookie' => $cookie,
            ':id' => $id
        ];

        DatabaseModel::exec($sql, $params);

        return $cookie;
    }

    /**
     * Delete database cookie.
     * 
     * @param int $id
     * 
     * @return void
     */
    private static function deleteDbCookie($id)
    {
        $sql = <<<SQL
            UPDATE user SET cookie = '' WHERE user_id = :id
        SQL;

        $params = [
            ':id' => $id
        ];

        DatabaseModel::exec($sql, $params);
    }

    /**
     * Set local and database cookie.
     * Check if database cookie exists, if not create one.
     * 
     * @param int $id
     * @param bool $stayLogin
     * 
     * @return void
     */
    public static function setLoginCookie($id, $stayLogin)
    {
        $dbCookie = self::getDbCookie($id);

        if (!$dbCookie) {
            $dbCookie = self::setDbCookie($id);
        }

        self::setLocalCookie($dbCookie, $stayLogin);
    }

    /**
     * Check if cookie exists.
     * 
     * @param string $cookie
     * 
     * @return int|bool Returns user ID if cookie exists, false if cookie is empty or otherwise
     */
    public static function validateCookie($cookie)
    {
        if (empty($cookie)) {
            return false;
        }

        $sql = <<<SQL
            SELECT user_id FROM user WHERE cookie = :cookie LIMIT 1
        SQL;

        $params = [
            ':cookie' => $cookie
        ];

        return DatabaseModel::exec($sql, $params)->fetchColumn();
    }
}
