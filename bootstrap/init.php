<?php

if(!isset($_SESSION)) session_start();

require_once __DIR__.'/../app/config/_env.php';
require_once __DIR__.'/../app/routing/routes.php';
require_once __DIR__.'/../app/routing/RouteDispatcher.php';

new App\RouteDispatcher($router);