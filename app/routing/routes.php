<?php

$router = new AltoRouter();
$router->setBasePath('checkmarksurveys/public/');

$router->map('GET', '/', 'App\Controllers\IndexController@index', 'home');
$router->map('GET', '/login', 'App\Controllers\AuthController@showLoginForm', 'loginForm');
$router->map('GET', '/register', 'App\Controllers\AuthController@showRegisterForm', 'registerForm');
$router->map('POST', '/register', 'App\Controllers\AuthController@register', 'register');
$router->map('POST', '/login', 'App\Controllers\AuthController@login', 'login');
$router->map('GET', '/logout', 'App\Controllers\AuthController@logout', 'logout');
$router->map('GET', '/surveys', 'App\Controllers\SurveyController@index', 'surveys');
$router->map('GET', '/createsurvey', 'App\Controllers\SurveyController@showSurveyForm', 'surveyForm');
$router->map('POST', '/sendsurvey', 'App\Controllers\SurveyController@sendSurvey', 'survey');
$router->map('GET', '/surveys/edit/[a:id]', 'App\Controllers\SurveyController@edit', 'edit');
$router->map('GET', '/surveys/respond/[a:id]', 'App\Controllers\SurveyController@response', 'respond');
$router->map('POST', '/edit/[a:id]', 'App\Controllers\SurveyController@editSurvey', 'editSurvey');
$router->map('POST', '/surveys/email', 'App\Controllers\SurveyController@sendEmail', 'email');
$router->map('POST', '/surveys/send/response', 'App\Controllers\SurveyController@sendResponse', 'response');
$router->map('GET', '/surveys/responses/[a:id]', 'App\Controllers\SurveyController@getResponse', 'getResponse');
$router->map('GET', '/surveys/get/responses/[a:id]', 'App\Controllers\SurveyController@getJsonResponse', 'getJsonResponse');
$router->map('DELETE', '/surveys/delete/[a:id]', 'App\Controllers\SurveyController@deleteSurvey', 'delete');

