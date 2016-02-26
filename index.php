<?php
require_once("config/config.php");
require_once("kernel/Loader.php");

use kernel\Router;

$router = new Router();

// Index Routen
$router->map('GET', '/', 'kernel/view/home.php', 'home');
$router->map('GET', '/index.php', 'kernel/view/home.php', 'home2');

$match = $router->match();

if (is_array($match) && !empty($match)) {
	if (!is_callable($match['target']) && strrpos($match['target'], "#") != 0) {
		require_once($match['targetWithoutMethod']);

		$match['class']::$match['method']();
	} else {
		if (is_callable($match['target'])) {
			call_user_func_array($match['target'], $match['params']);
		} else {
			require_once($match['target']);
		}
	}
} else {
	header("Content-Type: text/html; charset=utf-8");
	header("HTTP/1.1 404 Not Found");
	exit("<h1>Not Found</h1>The requested URL ".$_SERVER["REQUEST_URI"]." was not found on this server.");
}