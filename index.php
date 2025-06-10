<?php 
require 'class/core.php';
$ROUTER->get('/', fn() => include('views/go.php'));
$ROUTER->run();
?>
