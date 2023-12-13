<?php

namespace App\Models;

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

use PDO;
use App\Models\DatabaseModel;
use App\Models\CookieModel;
use App\Models\SessionModel;
use App\Models\ValidateModel;

class UserModel
{
    /**
     * Register user.
     * Validate email and password.
     * 
     * @param string $userName
     * @param string $email
     * @param string $password
     * 
     * @return bool|array Returns true if registration is successful, array of errors otherwise
     */
    public function register($userName, $email, $password)
    {
        $errors = $this->validateRegister($userName, $email, $password);
        if (count($errors) > 0) {
            return $errors;
        }

        $dirName = $this->getUniqueName($email);
        $password = $this->encryptPwd($password);

        // Role is set to public by default.
        $role = 'public';

        // Create user folder
        $this->addUserFolder($dirName);

        /**
         * @var string $sql Insert to user table.
         */
        $sql = <<<SQL
            INSERT INTO 
                user (dir_name, email, pwd, role) 
            VALUES 
                (:dirName, :email, :password, :role)
        SQL;

        $params = [
            ':dirName' => $dirName,
            ':email' => $email,
            ':password' => $password,
            ':role' => $role
        ];
        
        DatabaseModel::exec($sql, $params);

        $userId = DatabaseModel::connect()->lastInsertId();

        /**
         * @var string $sql_lang Insert to user_lang table.
         */
        $sql_lang = <<<SQL
            INSERT INTO user_lang (user_id, user_name) VALUES (:userId, :userName)
        SQL;

        $params_lang = [
            ':userId' => $userId,
            ':userName' => $userName
        ];

        DatabaseModel::exec($sql_lang, $params_lang);

        return true;
    }

    /**
     * Generate unique name from email.
     * 
     * @param string $email
     * 
     * @return string Returns unique name
     */
    private function getUniqueName($email)
    {
        $name = explode('@', $email)[0];
        $randName = getRand($name);
        
        /**
         * Check if name is unique.
         */
        while ($this->verifyUniqueName($randName)) {
            $randName = getRand($name);
        }

        return $randName;
    }

    /**
     * Verify if unique name already exists.
     * 
     * @param string $name
     * 
     * @return bool Returns true if name already exists, false otherwise
     */
    private function verifyUniqueName($name)
    {
        $sql = <<<SQL
            SELECT dir_name FROM user WHERE dir_name = :name
        SQL;

        $params = [
            ':name' => $name
        ];

        return DatabaseModel::exec($sql, $params)->rowCount() > 0;
    }

    /**
     * Validate registration.
     * 
     * @param string $name
     * @param string $email
     * @param string $password
     * 
     * @return array Returns array of errors
     */
    private function validateRegister($name, $email, $password)
    {
        $errors = [];
        
        if (empty($name)) {
            $errors['name'] = '*Required';
        }

        if (empty($email)) {
            $errors['email'] = '*Required';
        }

        if (empty($password)) {
            $errors['password'] = '*Required';
        }

        if (!ValidateModel::validateEmail($email) && !isset($errors['email'])) {
            $errors['email'] = '*Invalid email format';
        }
        
        if ($this->verifyEmail($email) && !isset($errors['email'])) {
            $errors['email'] = '*Email already registered';
        }
        
        if (!ValidateModel::validatePassword($password) && !isset($errors['password'])) {
            $errors['password'] = '*Invalid password format';
        }

        return $errors;
    }

    /**
     * Login user.
     * Validate email.
     * Verify password using email.
     * Set login cookie.
     * 
     * @param string $email
     * @param string $password
     * 
     * @return bool|array Returns true if login is successful, array of errors otherwise
     */
    public function login($email, $password)
    {
        $errors = $this->validateLogin($email, $password);

        if (count($errors) > 0) {
            return $errors;
        }

        $sql = <<<SQL
            SELECT user_id FROM user WHERE email = :email LIMIT 1
        SQL;

        $params = [
            ':email' => $email
        ];

        $id = DatabaseModel::exec($sql, $params)->fetchColumn();
        CookieModel::setLoginCookie($id);

        return true;
    }

    /**
     * Validate login.
     * 
     * @param string $email
     * @param string $password
     * 
     * @return array Returns array of errors
     */
    private function validateLogin($email, $password)
    {
        $errors = [];

        if (empty($email)) {
            $errors['email'] = '*Required';
        }

        if (empty($password)) {
            $errors['password'] = '*Required';
        }

        if (!ValidateModel::validateEmail($email) && !isset($errors['email'])) {
            $errors['email'] = '*Invalid email format';
        }

        if (!$this->verifyEmail($email) && !isset($errors['email'])) {
            $errors['email'] = '*Email not registered';
        }

        if (!$this->verifyPwd($email, $password) && !isset($errors['password']) && !isset($errors['email'])) {
            $errors['password'] = '*Incorrect password';
        }

        return $errors;
    }

    /**
     * Encrypt password.
     * 
     * @param string $password
     * 
     * @return string
     */
    private function encryptPwd($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Verify password.
     * 
     * @param string $email
     * @param string $password
     * 
     * @return bool Returns true if password is valid, false otherwise
     */
    private function verifyPwd($email, $password)
    {
        $sql = <<<SQL
            SELECT pwd FROM user WHERE email = :email
        SQL;

        $params = [
            ':email' => $email
        ];

        $hash = DatabaseModel::exec($sql, $params)->fetchColumn();

        return password_verify($password, $hash);
    }

    /**
     * Check if email is already registered.
     * 
     * @param string $email
     * 
     * @return bool Returns true if email is already registered, false otherwise
     */
    private function verifyEmail($email)
    {
        $sql = <<<SQL
            SELECT email FROM user WHERE email = :email
        SQL;

        $params = [
            ':email' => $email
        ];

        return DatabaseModel::exec($sql, $params)->rowCount() > 0;
    }

    /**
     * Get user info by ID.
     * 
     * @param int $id
     * 
     * @return array|bool Returns array if valid, false otherwise
     */
    public function getUserById($id)
    {
        $sql = <<<SQL
            SELECT * FROM user WHERE user_id = :id
        SQL;

        $params = [
            ':id' => $id
        ];

        $user = DatabaseModel::exec($sql, $params)->fetch(PDO::FETCH_ASSOC);

        $sql_lang = <<<SQL
            SELECT * FROM user_lang WHERE user_id = :id
        SQL;

        $params_lang = [
            ':id' => $id
        ];

        $user_lang = DatabaseModel::exec($sql_lang, $params_lang)->fetch(PDO::FETCH_ASSOC);

        $userInfo = array_merge($user, $user_lang);
        return $userInfo;
    }

    /**
     * Validate login status using cookie.
     * Set session if valid.
     * 
     * @return bool Returns true if valid, false otherwise
     */
    public function validateLoginStatus()
    {
        $localCookie = $_COOKIE['renew_user'] ?? '';
        $userId = CookieModel::validateCookie($localCookie);

        if (!$userId) {
            return false;
        }

        $userInfo = $this->getUserById($userId);
        SessionModel::setSession($userInfo, $localCookie, 'renew_user');

        return true;
    }

    /**
     * Get user full folder path.
     * 
     * @param string $name
     * 
     * @return string Returns full folder path
     */
    private function getUserFolderPath($name)
    {
        $path = ROOT . '/app/assets/user/' . $name;
        return $path;
    }

    /**
     * Add user folder.
     * 
     * @param string $name
     * 
     * @return bool Returns true if successful, false if file already exists
     */
    private function addUserFolder($name)
    {
        $path = $this->getUserFolderPath($name);

        if (file_exists($path)) {
            return false;
        }

        mkdir($path, 0755);
        return true;
    }

    /**
     * Get user directory.
     * 
     * @param int $userId
     * @param bool $withRoot (Optional) Default includes root directory
     * 
     * @return string Returns user directory
     */
    public static function getUserDir($userId, $withRoot = true)
    {
        /**
         * @var string $rootDir Root directory.
         */
        $rootDir = ROOT . '/app/assets/user/';

        if (!$withRoot) {
            $rootDir = '/app/assets/user/';
        }

        $sql = <<<SQL
            SELECT dir_name FROM user WHERE user_id = :userId
        SQL;

        $params = [
            ':userId' => $userId
        ];

        $dirName = DatabaseModel::exec($sql, $params)->fetchColumn();

        return $rootDir . $dirName;
    }

    /**
     * Get current user ID.
     * 
     * @return int
     */
    public static function getCurUserId()
    {
        return SessionModel::getSession('renew_user')['user_id'];
    }
}
