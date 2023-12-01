<?php

namespace App\Views;

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

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
     * Add view.
     * 
     * @param string $viewName
     * @param string $viewTitle
     * @param array $viewCss (Optional)
     * @param array $viewJs (Optional)
     * 
     * @return void|Exception Returns Exception if view exists.
     */
    public function addView($viewName, $viewTitle, $viewCss = [], $viewJs = [])
    {
        if (array_key_exists($viewName, self::$viewRawInfo)) {
            throw new \Exception('View already exists');
        }
        self::$viewRawInfo[$viewName] = [
            'title' => $viewTitle,
            'css' => $viewCss,
            'js' => $viewJs
        ];
    }

    /**
     * Render view based on view name.
     * 
     * @param string $viewName
     * @param array $params (Optional) For passing data to view.
     * 
     * @return void|Exception Returns Exception if view not found.
     */
    public static function renderView($viewName, $params = [])
    {
        $root = self::$root;

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

        require_once ROOT . '/app/views/viewlist/mainview.php';
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
