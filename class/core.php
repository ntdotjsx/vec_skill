<?php

$ROUTER = new class {
    private $routes = [];

    public function get(string $path, callable $callback) {
        $this->routes['GET'][$path] = $callback;
    }

    public function post(string $path, callable $callback) {
        $this->routes['POST'][$path] = $callback;
    }

    public function run() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach ($this->routes[$method] ?? [] as $path => $callback) {
            if ($path === $uri) {
                return call_user_func($callback);
            }
        }
        http_response_code(404);
        echo "404 Not Found";
    }
};

$RENDER = new class {
    private static $ad = [
        'card' => 'components/ui/user_card.php',
        'table' => 'components/ui/user_table.php',
        'product' => 'components/ui/product_card.php'
    ];

    protected static function renderTemplate(string $templatePath, array $data = []): string
    {
        extract($data);
        ob_start();
        include $templatePath;
        return ob_get_clean();
    }

    public static function __callStatic($name, $arguments)
    {
        if (isset(self::$ad[$name])) {
        return self::renderTemplate(self::$ad[$name], ['d' => $arguments[0]]);
        }
    }
}

?>