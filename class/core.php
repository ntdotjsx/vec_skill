<?php 
$ROUTER = new class {
    private $routes = [];

    public function get(string $path, callable $callback) {
        $this->routes['GET'][$path] = $callback;
        var_dump($this->routes['GET']);
    }

    public function post(string $path, callable $callback) {
        $this->routes['POST'][$path] = $callback;
    }

    public function run() {
        $method = $_SERVER["REQUEST_METHOD"];
        $uri = rtrim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), '/') ?: '/';

        foreach ($this->routes[$method] ?? [] as $path => $callback) {
            $pattern = preg_replace("/\{(\w+)\}/", "(?P<$1>[^/]+)", $path);
            $pattern = "#^" . rtrim($pattern, '/') . "$#";

            if (preg_match($pattern, $uri, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                return call_user_func_array($callback, $params);
            }
        }
        http_response_code(404);
        echo "404 ISUS";
    }
};

$RENDER = new class {
    protected static function renderTemplate(string $templatePath, array $data = []): string
    {
        extract($data);
        ob_start();
        include $templatePath;
        return ob_get_clean();
    }

    // public static function card(array $user): string
    // {
    //     return self::renderTemplate('components/ui/user_card.php', ['user' => $user]);
    // }

    // public static function table(array $users): string
    // {
    //     return self::renderTemplate('components/ui/user_table.php', ['users' => $users]);
    // }
}
?>