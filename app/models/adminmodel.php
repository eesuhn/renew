<?php

namespace App\Models;

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

use PDO;
use App\Models\DatabaseModel;

class AdminModel
{
    /**
     * Get all user
     * 
     * @return array
     */
    public function getAllUser()
    {
        $sql = <<<SQL
            SELECT
                u.*, ul.*
            FROM
                user u
            INNER JOIN
                user_lang ul ON u.user_id = ul.user_id
            WHERE
                u.is_delete = 0
        SQL;

        return DatabaseModel::exec($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Edit user role
     * 
     * @param int $userId
     * @param int $role
     * 
     * @return bool Return true if success
     */
    public function editUserRole($userId, $role)
    {
        $sql = <<<SQL
            UPDATE
                user
            SET
                role = :role
            WHERE
                user_id = :userId
        SQL;

        $params = [
            ':role' => $role,
            ':userId' => $userId
        ];

        DatabaseModel::exec($sql, $params);
        return true;
    }

    /**
     * Delete user
     * 
     * @param int $userId
     * 
     * @return bool Return true if success
     */
    public function deleteUser($userId)
    {
        $sql = <<<SQL
            UPDATE
                user
            SET
                is_delete = 1
            WHERE
                user_id = :userId
        SQL;

        $params = [
            ':userId' => $userId
        ];

        DatabaseModel::exec($sql, $params);
        return true;
    }
}
