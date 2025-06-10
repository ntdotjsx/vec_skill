<?php 
require 'class/core.php';

// $ROUTER->get('/user/{id}', function ($id) {
//     echo "User ID: " . htmlspecialchars($id);
// });

// $ROUTER->get('/post/{postId}/comment/{commentId}', function ($postId, $commentId) {
//     echo "Post ID: $postId, Comment ID: $commentId";
// });

$ROUTER->get('/', fn() => include('views/go.php'));
$ROUTER->run();
?>
