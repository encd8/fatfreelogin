<?php
// Kickstart the framework
$f3=require('lib/base.php');

/* Medoo */
require('vendors/Medoo.php');

/* Load configuration */
$f3->config('app/config.ini');

/* Load routes */
$f3->config("app/routes.ini");

/* Set up medoo */
use Medoo\Medoo;
$md_db = new Medoo([
    'database_type' => $f3->get('dbtype'),
    'database_name' => $f3->get('dbname'),
    'server' => $f3->get('dbhost'),
    'username' => $f3->get('dbuser'),
    'password' => $f3->get('dbpass'),
    'charset' => 'utf8'
]);

/* Load files */
$f3->set('AUTOLOAD','app/controllers/');

// Let's take off!
$f3->run();

