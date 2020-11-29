<?php

require_once './vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;


// $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/secret/fir-php-a5f3d-2209614f8194.json');

// $firebase = (new Factory)
//     ->withServiceAccount($serviceAccount)
//     ->create();

$factory = (new Factory)->withServiceAccount(__DIR__.'/secret/fir-php-a5f3d-2209614f8194.json');
$database = $factory->createDatabase();

// $database = $firebase->getDatabase();

die(print_r($database));