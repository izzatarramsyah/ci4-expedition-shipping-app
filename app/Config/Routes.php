<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'Dashboard::index', ['filter' => 'authenticate']);
$routes->get('login', 'UserController::index', ['filter' => 'redirectIfAuthenticated']);
$routes->get('logout', 'UserController::logout');
$routes->post('doLogin', 'UserController::doLogin');
$routes->get('shipments', 'ShipmentsController::index', ['filter' => 'authenticate']);
$routes->post('createShipments', 'ShipmentsController::createShipments');
$routes->post('updateShipments', 'ShipmentsController::updateShipments');
$routes->post('getCustomerByName', 'CustomerController::getCustomerByName');
$routes->get('printInvoice', 'ShipmentsController::printInvoice');
$routes->get('history', 'HistoryController::index', ['filter' => 'authenticate']);
$routes->post('checkHistory', 'HistoryController::checkHistory');
$routes->post('getShipmentDetail', 'ShipmentsController::getShipmentDetail');
$routes->post('getDeliveryStatusById', 'HistoryController::getDeliveryStatusById');
$routes->get('customer', 'CustomerController::index', ['filter' => 'authenticate']);
$routes->get('getListCustomer', 'CustomerController::getListCustomer');
$routes->post('updateStatusCustomer', 'CustomerController::updateStatusCustomer');
$routes->post('saveCustomer', 'CustomerController::saveCustomer');
$routes->post('updateCustomer', 'CustomerController::updateCustomer');
$routes->get('master', 'MasterController::index', ['filter' => 'authenticate']);
$routes->get('getListRoute', 'MasterController::getListRoute');
$routes->post('getRoute', 'MasterController::getRoute');
$routes->post('updateRoute', 'MasterController::updateRoute');
$routes->post('saveRoute', 'MasterController::saveRoute');
$routes->post('deleteRoute', 'MasterController::deleteRoute');
$routes->post('deleteCustomer', 'CustomerController::deleteCustomer');
$routes->get('getListWeight', 'MasterController::getListWeight');
$routes->post('saveWeight', 'MasterController::saveWeight');
$routes->post('deleteWeight', 'MasterController::deleteWeight');
$routes->post('getWeight', 'MasterController::getWeight');
$routes->post('updateWeight', 'MasterController::updateWeight');
$routes->get('shipping', 'ShipmentPackageController::index', ['filter' => 'authenticate']);
$routes->post('getDeliveryStatus', 'ShipmentPackageController::getDeliveryStatus');
$routes->get('getDeliveryStatusData', 'Dashboard::getDeliveryStatusData');
$routes->get('getLatestOrder', 'Dashboard::getLatestOrder');
