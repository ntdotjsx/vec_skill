<?php 
require 'class/db.php';
require 'class/core.php';

$ROUTER->get('/', fn() =>
print('test'));

$ROUTER->run();


?>
