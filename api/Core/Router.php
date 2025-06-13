<?php
namespace App\Core;

class Router {
    private $routes = [];

    public function addRoute($method, $path, $controllerAction) {
        $this->routes[$method][$path] = $controllerAction;
    }

    public function dispatch($method, $uri) {
        $uri = strtok($uri, '?');
        
        foreach ($this->routes[$method] as $path => $controllerAction) {
            $pattern = $this->convertToRegex($path);
            
            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches);
                
                list($controller, $action) = explode('@', $controllerAction);
                $controller = "App\\Controllers\\" . $controller;
                
                if (class_exists($controller)) {
                    $controllerInstance = new $controller();
                    
                    if (method_exists($controllerInstance, $action)) {
                        call_user_func_array([$controllerInstance, $action], $matches);
                        return;
                    }
                }
            }
        }
        
        http_response_code(404);
        echo json_encode(['error' => 'Route not found']);
    }

    private function convertToRegex($path) {
        $pattern = preg_replace('/\{[a-zA-Z]+\}/', '([a-zA-Z0-9_-]+)', $path);
        return "@^" . $pattern . "$@D";
    }
}