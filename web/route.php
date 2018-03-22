<?php
use App\controllers\PagesController;
use App\controllers\PostsController;
use App\controllers\loginController;
use App\Data\DB;
use App\Auth\Auth;

$router = new AltoRouter();
$pages = new PagesController();
$post = new PostsController();
$login = new loginController();

// map homepage
$router->addRoutes(array(
    array( 'GET', '/[i:id]', function($id) use($pages) { $pages->index($id);}),
    array( 'GET', '/', function() use($pages) { $pages->index(); }),
));





// match current request url
$match = $router->match();
// call closure or throw 404 status
if( $match && is_callable( $match['target'] ) ) {
    call_user_func_array( $match['target'], $match['params'] );
} else {
    // no route was matched
    header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}
