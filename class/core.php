<?php 
$ROUTER = new class {
    private $routes = [];

    public function get(string $path, callable $callback) {
        $this->routes['GET'][$path] = $callback;
    }

    public function post(string $path, callable $callback) {
        $this->routes['POST'][$path] = $callback;
    }

    private function addRoute(string $method, string $path, callable $callback) {
        $this->routes[$method][] = ['path' => $path, 'callback' => $callback];
    }

    public function run() {
    $method = $_SERVER["REQUEST_METHOD"];
    $uri = rtrim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), '/') ?: '/';
    foreach ($this->routes[$method] ?? [] as $path => $callback) {
        $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $route[$path]);
        $pattern = "#^". rtrim($pattern, '/'). "$#";
        if (preg_match($pattern, $uri, $matches)) {
            $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
            return call_user_func_array($route['callback'], $params);
        } 
    }
    http_response_code(404);
    echo "404 ISUS";
    }
}
?>