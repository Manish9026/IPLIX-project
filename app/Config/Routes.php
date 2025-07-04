<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Pages::index');

// ✅ Add your custom routes here:
$routes->get('/story', 'Pages::story');
$routes->get('/services', 'Pages::services');
$routes->get('/work', 'Pages::work');
$routes->get('/careers', 'Pages::careers');
$routes->get('/contact', 'Pages::contact');
$routes->get('/case-study', 'CaseStudyController::index');
// $routes->get('/dashboard', 'Pages::dashboard');
$routes->get('/dashboard/login', 'AuthController::loginPage');


// public api 
$routes->group("api",function($routes){
$routes->group("contact",function($routes){
$routes->post('clients/save', 'ContactController::saveClient');

});
    
});

$routes->group('dashboard', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'DashboardController::index'); // public
    $routes->get('home', 'DashboardController::home'); // public
    $routes->get('story', 'DashboardController::story'); // public
    $routes->get('services', 'DashboardController::services'); // public
    $routes->get('careers', 'DashboardController::career'); // public
    $routes->get('work', 'DashboardController::ourWork'); // public
    $routes->get('contact', 'DashboardController::contact'); // public

    $routes->get('hero', 'DashboardController::hero'); // public

});

$routes->group('api', ['filter' => 'auth'], function ($routes) {
    $routes->group('services', function ($routes) {

        $routes->get('(:segment)', 'Services::getById/$1');
        $routes->post('create', 'Services::create');
        $routes->put('update/(:segment)', 'Services::update/$1');
        $routes->delete('delete/(:segment)', 'Services::delete/$1');
    });
    $routes->group('work', function ($routes) {
        $routes->get("project/(:segment)", 'WorkController::getSingleProject/$1');
        $routes->post("project/create", 'WorkController::addProject');
        $routes->post("project/edit/(:segment)", 'WorkController::editProject/$1');
        $routes->delete("projects/delete/(:segment)", 'WorkController::deleteProject/$1');
    });
    $routes->group('story', function ($routes) {
        $routes->post("timeline", 'StoryController::saveTimeline');
        $routes->delete('timeline/(:num)', 'StoryController::deleteTimeline/$1');

        // stats routs
        $routes->post("stats", 'StoryController::saveStats');
        $routes->delete('stats/(:num)', 'StoryController::deleteStat/$1');

        // team-member routes

        $routes->post("teams", 'StoryController::saveTeamMember');
        $routes->delete('teams/(:num)', 'StoryController::deleteTeam/$1');

        // gallery routes saveGallery
        $routes->post("gallery", 'StoryController::saveGallery');
        $routes->delete('gallery/(:any)', 'StoryController::deleteGallery/$1');
    });

    $routes->group("contact", function ($routes) {
        $routes->post('save', 'ContactController::saveContact');
        $routes->delete('delete/(:any)', 'ContactController::deleteContact/$1');
        $routes->post('company/save', 'ContactController::saveCompanyInfo');
        $routes->post('social/save', 'ContactController::saveSocial');
        $routes->delete('social/delete/(:segment)', 'ContactController::deleteSocial/$1');
        $routes->delete('clients/delete/(:segment)', 'ContactController::deleteClient/$1');
    });


    $routes->post("hero/save", 'HeroController::saveHeroContent');
    $routes->get('hero/(:segment)', 'HeroController::getHeroData/$1');

    $routes->get('story/(:segment)', 'Story::getById/$1');
});

$routes->group('api/auth', function ($routes) {
    $routes->post('register', 'AuthController::register');
    $routes->post('login', 'AuthController::login');
    $routes->post('logout', 'AuthController::logout');
    $routes->get('verify', 'AuthController::verify');
});
