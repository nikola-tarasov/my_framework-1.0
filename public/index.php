<?php
error_reporting(-1);

$query =  rtrim( $_SERVER['QUERY_STRING'], '/');

use vendor\core\Router;


define('WWW', __DIR__);
define('CORE', dirname(__DIR__) . '/vendor/core');
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) . '/app');


require '../vendor/core/Router.php';
require '../vendor/libs/functions.php';
// require '../app/controllers/Main.php';
// require '../app/controllers/Posts.php';
// require '../app/controllers/PostsNews.php';


// Router::add('posts/add', ['controller'=>'Posts','action'=>'add']);
// Router::add('posts', ['controller'=>'Posts','action'=>'index']);
// Router::add('', ['controller'=>'Main','action'=>'index']);

// function app($class)
// {
//     $file = APP . "/controllers/$class.php";
//     if ($file) {
//         require_once $file;
//     }
// };    

spl_autoload_register(function($class)
{
    $file = ROOT . '/' . str_replace('\\', '/',  $class) . '.php';
    // $file = APP . "/controllers/$class.php";
    if (is_file($file)) {
        require_once $file;
    }
});



Router::add('^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$', ['controller' => 'Page']);
Router::add('^page/(?P<alias>[a-z-]+)$', ['controller' => 'Page', 'action' => 'view']);

// default routs
Router::add('^$', ['controller'=> 'Main', 'action'=>'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

Router::dispatch($query);
