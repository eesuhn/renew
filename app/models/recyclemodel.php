<?php

namespace App\Models;

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

use PDO;
use App\Models\DatabaseModel;
use DateTime;

class RecycleModel
{
    /**
     * Get recycle centers by id.
     * 
     * @param int $centerId
     * 
     * @return array|bool Returns array of recycle centers if found, false otherwise.
     */
    public function getRecCenterById($centerId)
    {
        $sql = <<<SQL
            SELECT 
                *
            FROM
                rec_center
            WHERE
                center_id = :centerId
        SQL;

        $params = [
            ':centerId' => $centerId
        ];

        return DatabaseModel::exec($sql, $params)->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get all recycle centers in descending order.
     * 
     * @return array Returns array of recycle centers.
     */
    public function getAllRecCenterDesc()
    {
        $sql = <<<SQL
            SELECT 
                center_id
            FROM
                rec_center
            ORDER BY
                center_id DESC
        SQL;

        $arrId = DatabaseModel::exec($sql)->fetchAll(PDO::FETCH_COLUMN);

        $arr = [];
        foreach ($arrId as $centerId) {
            $arr[] = $this->getRecCenterById($centerId);
        }

        return $arr;
    }

    /**
     * Recycle an item.
     * 
     * @param int $userId
     * @param string $recName
     * @param float $recWeight
     * @param int $recCenterId
     * @param string $recDateTime
     * @param array $recImg
     * 
     * @return bool|array Returns true if successful, array of errors otherwise.
     */
    public function recycle(
        $userId, 
        $recName,
        $recWeight,
        $recCenterId,
        $recDateTime,
        $recImg)
    {
        $errors = $this->validateRecycle(
            $recName,
            $recWeight,
            $recDateTime,
            $recImg
        );
        if (count($errors) > 0) {
            return $errors;
        }

        $dirName = $this->getUniqueDirName($recName);

        /**
         * Default recycle status.
         * 
         * @var string $defaultRecStatus
         */
        $defaultRecStatus = 'pending';

        $sql = <<<SQL
            INSERT INTO
                recyclable (
                    user_id, 
                    dir_name, 
                    center_id, 
                    rec_status,
                    rec_time
                )
            VALUES 
                (
                    :userId, 
                    :dirName, 
                    :centerId, 
                    :recStatus,
                    :recTime
                )
        SQL;

        $params = [
            ':userId' => $userId,
            ':dirName' => $dirName,
            ':centerId' => $recCenterId,
            ':recStatus' => $defaultRecStatus,
            ':recTime' => $recDateTime
        ];

        DatabaseModel::exec($sql, $params);

        $recId = DatabaseModel::connect()->lastInsertId();

        /**
         * @var string $sql_lang Insert to rec_lang table.
         */
        $sql_lang = <<<SQL
            INSERT INTO 
                rec_lang (rec_id, rec_name, weight, img_path)
            VALUES 
                (:recId, :recName, :weight, :imgPath)
        SQL;

        $params_lang = [
            ':recId' => $recId,
            ':recName' => $recName,
            ':weight' => $recWeight,
            ':imgPath' => $recImg['fileName']
        ];

        DatabaseModel::exec($sql_lang, $params_lang);

        return true;
    }

    /**
     * Validate recycle form.
     * 
     * @param string $recName
     * @param float $recWeight
     * @param string $recDateTime
     * @param array $recImg
     * 
     * @return array Returns array of errors.
     */
    private function validateRecycle(
        $recName,
        $recWeight,
        $recDateTime,
        $recImg)
    {
        $errors = [];

        if (empty($recName)) {
            $errors['recName'] = '*Required';
        }

        if (empty($recWeight)) {
            $errors['recWeight'] = '*Required';
        }

        if (empty($recDateTime)) {
            $errors['recDateTime'] = '*Required';
        }

        if (!is_numeric($recWeight) && !isset($errors['recWeight'])) {
            $errors['recWeight'] = '*Must be a number';
        }

        $curDateTime = new DateTime();
        $curDateTime = $curDateTime->format('Y-m-d H:i:s');

        if ($recDateTime < $curDateTime && !isset($errors['recDateTime'])) {
            $errors['recDateTime'] = '*Must be a future date and time';
        }

        if (isset($recImg['error'])) {
            $errors['recImg'] = $recImg['error'];
        }

        return $errors;
    }

    /**
     * Get unique name for recyclable directory.
     * 
     * @param string $recName
     * 
     * @return string Returns unique name for recyclable directory.
     */
    private function getUniqueDirName($recName)
    {
        $recName = preg_replace('/\s+/', '', $recName);
        $randName = getRand($recName);

        while ($this->verifyUniqueDirName($randName)) {
            $randName = getRand($recName);
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
                *
            FROM
                recyclable
            WHERE
                dir_name = :dirName
        SQL;

        $params = [
            ':dirName' => $dirName
        ];

        return DatabaseModel::exec($sql, $params)->rowCount() > 0;
    }

    /**
     * Get recyclable by user id.
     * 
     * @param int $userId
     * 
     * @return array|bool Returns array of recyclables if found, false otherwise.
     */
    public function getRecByUserId($userId)
    {
        $sql = <<<SQL
            SELECT
                r.*, rl.*, rc.*
            FROM
                recyclable r
            INNER JOIN
                rec_lang rl ON r.rec_id = rl.rec_id
            INNER JOIN
                rec_center rc ON r.center_id = rc.center_id
            WHERE
                r.user_id = :userId
        SQL;

        $params = [
            ':userId' => $userId
        ];

        return DatabaseModel::exec($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get all recyclables.
     * 
     * @return array Returns array of recyclables.
     */
    public function getAllRec()
    {
        $sql = <<<SQL
            SELECT
                r.*, rl.*, rc.*
            FROM
                recyclable r
            INNER JOIN
                rec_lang rl ON r.rec_id = rl.rec_id
            INNER JOIN
                rec_center rc ON r.center_id = rc.center_id
        SQL;

        return DatabaseModel::exec($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Update recyclable.
     * 
     * @param int $recId
     * @param float $recPoint
     * @param string $recStatus
     * 
     * @return bool Returns true if successful.
     */
    public function updateRec($recId, $recPoint, $recStatus)
    {
        $sql = <<<SQL
            UPDATE
                recyclable
            SET
                rec_point = :recPoint,
                rec_status = :recStatus
            WHERE
                rec_id = :recId
        SQL;

        $params = [
            ':recPoint' => $recPoint,
            ':recStatus' => $recStatus,
            ':recId' => $recId
        ];

        DatabaseModel::exec($sql, $params);
        return true;
    }
}
