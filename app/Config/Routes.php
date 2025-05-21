<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('invoices', 'InvoiceController::index');
$routes->post('invoices', 'InvoiceController::index');
$routes->get('invoices/xml/(:num)', 'InvoiceController::getInvoiceAsXml/$1');
$routes->get('invoices/xml', 'InvoiceController::getInvoicesAsXml');
$routes->post('invoices/update/(:num)', 'InvoiceController::updateInvoice/$1');
$routes->post('invoices/delete/(:num)', 'InvoiceController::deleteInvoice/$1');