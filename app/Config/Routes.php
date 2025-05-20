<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('invoices', 'InvoiceController::index');
$routes->post('invoices', 'InvoiceController::index');
$routes->get('invoices/xml/(:num)', 'InvoiceController::getInvoiceAsXml/$1');