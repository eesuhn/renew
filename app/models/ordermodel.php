<?php

namespace App\Models;

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

use PDO;
use App\Models\DatabaseModel;

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
}
