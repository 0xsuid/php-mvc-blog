<?php

namespace Harsh\Blog\Helper;

class Router
{
    private $controllers = [];
    private  $notFoundController;
    private const POST_METHOD = 'POST';
    private const GET_METHOD = 'GET';

    public function get(string $path, $controller)
    {
        $this->addController(self::GET_METHOD, $path, $controller);
    }

    public function post(string $path, $controller)
    {
        $this->addController(self::POST_METHOD, $path, $controller);
    }

    public function addNotFoundController($controller)
    {
        $this->notFoundController = $controller;
    }

    private function addController(string $method, string $path, $controller)
    {
        $this->controllers[] = [
            'path' => $path,
            'method' => $method,
            'controller' => $controller
        ];
    }

    private function getClassInstance($callback)
    {
        // Get classname and create class instance
        $className = array_shift($callback);
        $controller = new $className;

        // Get method name
        $method = array_shift($callback);
        $callback = [
            $controller,
            $method
        ];
        return $callback;
    }

    public function execute()
    {
        $requestURI = parse_url($_SERVER['REQUEST_URI']);
        $requestPath = $requestURI['path'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        $currentController = null;
        // Find controller for requested Path & Method
        foreach ($this->controllers as $controller) {
            if ($requestPath === $controller['path']  && $requestMethod === $controller['method']) {
                $currentController = $controller['controller'];
                break;
            }
        }

        // To invoke methods of a class
        if (is_array($currentController)) {
            $currentController = $this->getClassInstance($currentController);
        }

        // When Unkown route is requested - 404 page
        if (!$currentController) {
            if (!empty($this->notFoundController)) {
                $currentController = $this->getClassInstance($this->notFoundController);
            }
        }

        // Call a callback with an array of parameters
        call_user_func_array($currentController, [
            array_merge($_GET, $_POST)
        ]);
    }
}
