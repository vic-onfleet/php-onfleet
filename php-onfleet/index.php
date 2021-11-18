<?php
require 'vendor/autoload.php';

use Onfleet\Onfleet;


$config = json_decode(file_get_contents("config.json"), false);

$onfleet = new Onfleet($config->apiKey, 70000, null);
// $client = new CurlClient();
// $task = new Task($client);
var_dump($onfleet->verifyKey());
var_dump($onfleet->tasks->get(["from" => strtotime("2021-11-08") . "000"]));

// var_dump($client->authenticate("https://onfleet.com/api/v2", $config->apiKey));
