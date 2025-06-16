<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// ✅ Add your custom routes here:
$routes->get('/story', 'Pages::story');
$routes->get('/services', 'Pages::services');
$routes->get('/work', 'Pages::work');
$routes->get('/careers', 'Pages::careers');
$routes->get('/case-study', 'CaseStudyController::index');
// $routes->get('story', 'StoryController::index');
