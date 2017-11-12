<?php
require "vendor/autoload.php";
$f3=\Base::instance();
$f3->config('apps/config/env.ini');
validate_app_key();
if($f3->get('ENV')=='production') $config_path='apps/config/prod';
elseif($f3->get('ENV')=='development') $config_path='apps/config/dev';
$f3->config("$config_path/config.ini");
$f3->config("$config_path/db.ini");
date_default_timezone_set('UTC');
$f3->config('apps/route.ini');
$f3->run();