<?php
require 'vendor/autoload.php';

use \Onfleet\CurlClient;
use \Onfleet\Task;


$config = file_get_contents("config.json");
$config = json_decode($config, true);

$client = new CurlClient($config["apiKey"]);
$task = new Task($client);

if ($client->testAuth()) {
    echo "here";
}



