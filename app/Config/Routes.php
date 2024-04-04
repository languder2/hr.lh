<?php
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
/** ADMIN: EXIT  */
$routes->get('/admin/exit/', [\App\Controllers\AuthController::class, 'exit']);
$routes->get('/exit/', [\App\Controllers\AuthController::class, 'exit']);
/** ADMIN: AUTH  */
$routes->match(['get','post'],'/admin/', [\App\Controllers\AuthController::class, 'auth']);
/** ADMIN: RESULTS  */
$routes->match(['get','post'],'/admin/results', [\App\Controllers\ResultsController::class, 'list']);
$routes->match(['get','post'],'/admin/results/add', [\App\Controllers\ResultsController::class, 'form']);
$routes->match(['get','post'],'/admin/results/edit/(:num)', [\App\Controllers\ResultsController::class, 'form/edit/$1']);
$routes->match(['get','post'],'/admin/results/form/processing', [\App\Controllers\ResultsController::class, 'processing']);
$routes->match(['get','post'],'admin/results/status', [\App\Controllers\ResultsController::class, 'status']);
$routes->match(['get','post'],'admin/results/remove/(:num)', [\App\Controllers\ResultsController::class, 'delete/$1']);
/** ADMIN: POLLS  */
$routes->match(['get','post'],'/admin/polls', [\App\Controllers\PollsController::class, 'list']);
$routes->match(['get','post'],'/admin/polls/add', [\App\Controllers\PollsController::class, 'form']);
$routes->match(['get','post'],'/admin/polls/edit/(:num)', [\App\Controllers\PollsController::class, 'form/edit/$1']);
$routes->match(['get','post'],'/admin/polls/form/processing', [\App\Controllers\PollsController::class, 'processing']);
$routes->match(['get','post'],'admin/polls/status', [\App\Controllers\PollsController::class, 'status']);
$routes->match(['get','post'],'admin/polls/remove/(:num)', [\App\Controllers\PollsController::class, 'delete/$1']);
$routes->match(['get','post'],'admin/polls/remove/(:num)/(:num)/', [\App\Controllers\PollsController::class, 'delete/$1/$2']);






