<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/login', 'Home::login');
$routes->get('/dashboard', 'Home::dashboard');
$routes->get('/product', 'Home::product');
$routes->get('/add_product', 'Home::add_product');
$routes->post('/insert_data_product', 'Home::insert_data_product');
$routes->post('/update_data_product', 'Home::update_data_product');
$routes->post('/delete_data_product', 'Home::delete_data_product');
$routes->post('/search', 'Home::search');
$routes->post('/search_category', 'Home::search_category');
$routes->get('/export-excel', 'Home::exportExcel');
$routes->get('/user_profile', 'Home::user_profile');
$routes->post('/update_data_candidate', 'Home::update_data_candidate');
$routes->get('/logout', 'Home::logout');
$routes->get('/tampilan_segitiga', 'tampilan::tampilan_segitiga');