<?php

use App\Controllers\AuthController;
use App\Controllers\PollsController;
use App\Controllers\ResultsController;
use App\Controllers\AppsController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
/** ADMIN: EXIT  */
$routes->get('/admin/exit/', [AuthController::class, 'exit']);
$routes->get('/exit/', [AuthController::class, 'exit']);
/** ADMIN: AUTH  */
$routes->match(['get','post'],'/admin/', [AuthController::class, 'auth']);
/** ADMIN: RESULTS  */
$routes->match(['get','post'],'/admin/results', [ResultsController::class, 'list']);
$routes->match(['get','post'],'/admin/results/add', [ResultsController::class, 'form']);
$routes->match(['get','post'],'/admin/results/edit/(:num)', [ResultsController::class, 'form/edit/$1']);
$routes->match(['get','post'],'/admin/results/form/processing', [ResultsController::class, 'processing']);
$routes->match(['get','post'],'admin/results/status', [ResultsController::class, 'status']);
$routes->match(['get','post'],'admin/results/remove/(:num)', [ResultsController::class, 'delete/$1']);
/** ADMIN: POLLS  */
$routes->match(['get','post'],'/admin/polls', [PollsController::class, 'list']);
$routes->match(['get','post'],'/admin/polls/add', [PollsController::class, 'form']);
$routes->match(['get','post'],'/admin/poll/edit/(:num)', [PollsController::class, 'form/edit/$1/$2']);
$routes->match(['get','post'],'/admin/poll/remove/(:num)', [PollsController::class, 'remove']);
$routes->match(['get','post'],'/admin/polls/form/processing', [PollsController::class, 'processing']);
$routes->match(['get','post'],'/admin/poll/change/status', [PollsController::class, 'changeStatus']);
/** Client: POLLS  */
$routes->match(['get','post'],'/apps/save_result', [AppsController::class, 'saveResult']);
$routes->match(['get','post'],'/polls/(:num)/', [PollsController::class, 'display/$1']);
$routes->match(['get','post'],'/polls/', [PollsController::class, 'display']);
$routes->match(['get','post'],'/', [PollsController::class, 'display/1']);
/** TEST */
$routes->get('/test', [AppsController::class, 'test']);
/** APPS */
$routes->match(['get','post'],'/admin/apps', [AppsController::class, 'list']);
$routes->match(['get','post'],'/admin/apps/change/status', [AppsController::class, 'changeStatus']);
$routes->match(['get','post'],'/admin/apps/set/filter', [AppsController::class, 'setFilter']);
$routes->match(['get','post'],'/admin/apps/modal', [AppsController::class, 'list/modal']);
$routes->match(['get','post'],"/admin/app/detail/(:any)", [AppsController::class, 'detail']);
$routes->match(['get','post'],"/admin/app/addComment", [AppsController::class, 'addComment']);
$routes->match(['get','post'],"/admin/app/(:num)/comment/remove/(:num)", [AppsController::class, 'removeComment']);
$routes->match(['get','post'],"/admin/app/change/personal", [AppsController::class, 'changeApp']);
/** CLIENT */