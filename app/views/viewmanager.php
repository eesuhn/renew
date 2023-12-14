<?php

namespace App\Views;

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

use App\Models\UserModel;
use App\Models\ValidateModel;

class ViewManager
{
    /**
     * Root URI.
     * 
     * @var string $root
     */
    private static $root = ROOT_URI;

    /**
     * View information.
     * 
     * @var array $viewRawInfo
     */
    private static $viewRawInfo = [];

    /**
     * Segment information.
     * 
     * @var array $segRawInfo
     */
    private static $segRawInfo = [];

    /**
     * Navigation information.
     * 
     * @var array $navRawInfo
     */
    private static $navRawInfo = [];

    /**
     * Add view.
     * 
     * @param string $viewName
     * @param string $viewTitle
     * @param array $viewCss (Optional)
     * @param array $viewJs (Optional)
     * @param array $permission (Optional) For permission checking.
     * @param bool $login (Optional) For login checking.
     * 
     * @return void|Exception Returns Exception if view exists.
     */
    public function addView(
        $viewName, 
        $viewTitle, 
        $viewCss = [], 
        $viewJs = [],
        $permission = [],
        $login = false)
    {
        if (array_key_exists($viewName, self::$viewRawInfo)) {
            throw new \Exception('View already exists');
        }
        self::$viewRawInfo[$viewName] = [
            'title' => $viewTitle,
            'css' => $viewCss,
            'js' => $viewJs,
            'permission' => $permission,
            'login' => $login
        ];
    }

    /**
     * Render view based on view name.
     * 
     * @param string $viewName
     * @param array $params (Optional) For passing data to view.
     * @param string $navName (Optional) For rendering navigation bar.
     * 
     * @return void|Exception Returns Exception if view not found.
     */
    public static function renderView(
        $viewName, 
        $params = [], 
        $navName = [])
    {
        $root = self::$root;

        self::hookBeforeRenderView($viewName);

        if (!array_key_exists($viewName, self::$viewRawInfo)) {
            throw new \Exception('View not found');
        }
        $viewRawInfo = self::$viewRawInfo[$viewName];

        $viewInfo = [
            'title' => $viewRawInfo['title'] . ' | ReNew',
            'body' => self::returnViewBody($viewName, $params),
            'css' => $viewRawInfo['css'] ?? [],
            'js' => $viewRawInfo['js'] ?? []
        ];

        /**
         * Render navigation bar.
         */
        $viewInfo['nav']['top'] = '';
        $viewInfo['nav']['bottom'] = '';

        $navIndex = 0;
        while (count($navName) > $navIndex) {
            $curNavName = $navName[$navIndex];

            if (array_key_exists($curNavName, self::$navRawInfo)) {
                $navBody = self::returnNavBody($curNavName, $params);
                $viewInfo['nav']['top'] .= $navBody['top'];
                $viewInfo['nav']['bottom'] .= $navBody['bottom'];
                
                $viewInfo['css'] = array_merge($viewInfo['css'], self::$navRawInfo[$curNavName]['css']);
                $viewInfo['js'] = array_merge($viewInfo['js'], self::$navRawInfo[$curNavName]['js']);
            }
            $navIndex++;
        }

        require_once ROOT . '/app/views/mainview.php';
    }

    /**
     * Hook before rendering view.
     * 
     * @param string $viewName
     * 
     * @return void
     */
    private static function hookBeforeRenderView($viewName)
    {
        self::loginCheck($viewName);
        self::permissionCheck($viewName);
    }

    /**
     * Login checking.
     * 
     * @param string $viewName
     * 
     * @return void
     */
    private static function loginCheck($viewName)
    {
        if ((self::$viewRawInfo[$viewName]['login']) == true) {

            if (!ValidateModel::validateLogin()) {
                header('Location: /renew/login');
                die();
            }
        }
    }

    /**
     * Permission checking.
     * 
     * @param string $viewName
     * 
     * @return void
     */
    private static function permissionCheck($viewName)
    {
        if (!empty(self::$viewRawInfo[$viewName]['permission'])) {
            $perArr = self::$viewRawInfo[$viewName]['permission'];

            $curRole = UserModel::getCurUserRole();

            if (!in_array($curRole, $perArr)) {
                header('Location: /renew/');
                die();
            }
        }
    }

    /**
     * Add navigation bar.
     * 
     * @param string $navName
     * @param array $navCss (Optional)
     * @param array $navJs (Optional)
     * 
     * @return void|Exception Returns Exception if navigation bar exists.
     */
    public function addNav($navName, $navCss = [], $navJs = [])
    {
        if (array_key_exists($navName, self::$navRawInfo)) {
            throw new \Exception('Navbar already exists');
        }
        self::$navRawInfo[$navName] = [
            'css' => $navCss,
            'js' => $navJs
        ];
    }

    /**
     * Return navigation bar body.
     * 
     * @param string $navName
     * @param array $params (Optional) For passing data to navigation bar.
     * 
     * @return string
     */
    private static function returnNavBody($navName, $params)
    {
        $root = self::$root;

        require_once ROOT . '/app/views/navlist/' . $navName . '.php';
        return $nav;
    }

    /**
     * Return view body.
     * 
     * @param string $viewName
     * @param array $params (Optional) For passing data to view.
     * 
     * @return string
     */
    private static function returnViewBody($viewName, $params)
    {
        $root = self::$root;

        require_once ROOT . '/app/views/viewlist/' . $viewName . '.php';
        return $body;
    }

    /**
     * Add view css.
     * 
     * @param string $viewName
     * @param string $cssName
     * 
     * @return void|Exception Returns Exception if CSS exists.
     */
    public static function addCss($viewName, $cssName)
    {
        foreach (self::$viewRawInfo as $viewRawInfo) {
            $viewCss = $viewRawInfo['css'] ?? [];
            
            if (array_key_exists($cssName, $viewCss)) {
                throw new \Exception('CSS already exists');
            }
        }
        self::$viewRawInfo[$viewName]['css'][] = $cssName;
    }

    /**
     * Add view js.
     * 
     * @param string $viewName
     * @param string $jsName
     * 
     * @return void|Exception Returns Exception if JS exists.
     */
    public static function addJs($viewName, $jsName)
    {
        foreach (self::$viewRawInfo as $viewRawInfo) {
            $viewJs = $viewRawInfo['js'] ?? [];

            if (array_key_exists($jsName, $viewJs)) {
                throw new \Exception('JS already exists');
            }
        }
        self::$viewRawInfo[$viewName]['js'][] = $jsName;
    }

    /**
     * Add segment.
     * 
     * @param string $segName
     * 
     * @return void|Exception Returns Exception if segment exists.
     */
    public function addSeg($segName)
    {
        if (array_key_exists($segName, self::$segRawInfo)) {
            throw new \Exception('Segment already exists');
        }
        self::$segRawInfo[$segName] = true;
    }

    /**
     * Return segment body.
     * 
     * @param string $segName
     * 
     * @return string
     */
    private static function returnSegBody($segName, $params)
    {
        $root = self::$root;

        require_once ROOT . '/app/views/segments/' . $segName . '.php';
        return $body;
    }

    /**
     * Render segment based on segment name.
     * 
     * @param string $segName
     * @param array $params (Optional) For passing data to segment.
     * 
     * @return void|Exception Returns Exception if segment not found.
     */
    public static function renderSeg($segName, $params = [])
    {
        $root = self::$root;

        if (!array_key_exists($segName, self::$segRawInfo)) {
            throw new \Exception('Segment not found');
        }

        echo self::returnSegBody($segName, $params);
    }
}
