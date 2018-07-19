<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'redirect';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['login'] = 'redirect/login';
$route['register'] = 'redirect/register';
$route['signup'] = 'redirect/signup';
$route['home'] = 'redirect/home';
$route['functions'] = 'redirect';
$route['filFaskesKota'] = 'redirect/filFaskesKota';
$route['filFaskesKlinik'] = 'redirect/filFaskesKlinik';
$route['searchFaskes'] = 'redirect/searchFaskes';
$route['getlistlayanan'] = 'redirect/getListLayanan';
$route['getlistjamkes'] = 'redirect/getListJamkes';
