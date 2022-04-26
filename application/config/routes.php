<?php
defined('BASEPATH') or exit('No direct script access allowed');

// for login module
$route['authentication'] = 'login/authentication';

// for logout module
$route['logout'] = 'logout';

// for customer module
$route['add_user'] = 'customer/add_user';
$route['users'] = 'customer/store';
$route['customer_list'] = 'customer';
$route['show/(:any)'] = 'customer/show/$1';
$route['update_customer'] = 'customer/update_customer';

$route['page/menu/(:any)/(:any)'] = 'page/menu/$1/$2';
$route['default_controller'] = 'page/menu';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
