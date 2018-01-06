<?php

use DevOp\Core\Config;

include_once './vendor/autoload.php';

defined('DS') ? : define('DS', DIRECTORY_SEPARATOR);

$config = new Config(implode(DS, ['.', 'tests', 'config', 'config.php']), 'dev', implode(DS, ['.', 'tests', 'config', 'env.php']));

var_dump($config->all());
var_dump($config->get('database.password', 'test'));
