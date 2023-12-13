<?php

namespace App\Routes;

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

use App\Models\UserModel;
use App\Models\DatabaseModel;
use App\Views\ViewManager;

class RouteManager
{
    /**
     * List of routes.
     * 
     * @var array $routeList
     */
    private $routeList = [];

    /**
     * Handle route based on request URI and request method.
     * 
     * @param string $requestUri
     * @param string $requestMethod
     * 
     * @return void|Exception
     * Redirect to 404 page if route not found.
     * Return Exception if controller or method not found.
     */
    public function handleRoute($requestUri, $requestMethod)
    {
        $this->hookActionBeforeRoute();
        
        $requestUri = $this->cleanUri($requestUri);

        $matchedRoute = null;
        foreach ($this->routeList as $route) {
            if ($route['uri'] === $requestUri && $route['method'] === $requestMethod) {
                $matchedRoute = $route;
                break;
            }
        }

        if ($matchedRoute === null) {
            /**
             * Redirect to 404 page when route not found.
             */
            ViewManager::renderView('invalidview');
            exit();
        }

        [$controller, $method] = explode('@', $matchedRoute['route']);
        $controller = 'App\\Controllers\\' . $controller;

        if (!class_exists($controller)) {
            throw new \Exception('Controller not found');
        }

        $controllerObj = new $controller;

        if (!method_exists($controllerObj, $method)) {
            throw new \Exception('Method not found');
        }

        $controllerObj->$method();
    }

    /**
     * Remove trailing slash from URI.
     * Keep trailing slash if URI is /renew/.
     * 
     * @param string $uri
     * 
     * @return string
     */
    private function cleanUri($uri)
    {
        $path = parse_url($uri, PHP_URL_PATH);
        return ($path !== '/renew/') ? rtrim($path, '/') : $path;
    }

    /**
     * Add route to route list.
     * 
     * @param string $uri
     * @param string $route
     * @param string $method
     * 
     * @return void|Exception Returns Exception if route already exists.
     */
    private function addRoute($uri, $route, $method)
    {
        $this->routeList[] = [
            'uri' => '/renew' . $uri,
            'route' => $route,
            'method' => $method
        ];
    }

    /**
     * Add GET route to route list.
     * 
     * @param string $uri
     * @param string $route
     * 
     * @return void
     */
    public function get($uri, $route)
    {
        $this->addRoute($uri, $route, 'GET');
    }

    /**
     * Add POST route to route list.
     * 
     * @param string $uri
     * @param string $route
     * 
     * @return void
     */
    public function post($uri, $route)
    {
        $this->addRoute($uri, $route, 'POST');
    }

    /**
     * Hook: Action before routing request.
     * 
     * @return void
     */
    private function hookActionBeforeRoute()
    {
        // Check if database is setup.
        if (!DatabaseModel::validateDbSetup()) {
            ViewManager::renderView('installerview');
            exit();
        } else {
            DatabaseModel::validateSampleSetup();
        }
        
        // Check if user is logged in.
        $um = new UserModel();
        $um->validateLoginStatus();
    }
}
