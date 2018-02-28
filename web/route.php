<?php
use App\Services\PagesController;
use App\Services\PostsController;
use App\Data\DB;

$router = new AltoRouter();
$pages = new PagesController();
$post = new PostsController();

// map homepage
$router->addRoutes(array(
    array( 'GET', '/[i:id]', function($id) use($pages) { $pages->index($id);}),
    array( 'GET', '/', function() use($pages) { $pages->index(); }),
    array( 'GET', '/dashboard', function() use($pages) { $pages->dashboard(); }),
    array( 'GET', '/about', function() use($pages) { $pages->about(); }),

    array( 'GET', '/login', function() use($pages) { $pages->login(); }),
    array( 'POST', '/login', function() use($post) { $post->loginPost(); }),

    array( 'GET', '/register', function() use($pages) { $pages->register(); }),
    array( 'POST', '/register', function() use($post) { $post->registerPost(); }),

    array( 'GET', '/logout', function() use($post) { $post->logout(); }),

    array( 'GET', '/contact', function() use($pages) { $pages->contact(); }),
    array( 'POST', '/contact', function() use($post) { $post->contactPost(); })
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
