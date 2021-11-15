<?php
require 'vendor/autoload.php';

use Onfleet\Onfleet;


$config = json_decode(file_get_contents("config.json"), false);

$onfleet = new Onfleet($config->apiKey, 70000, null);
// $client = new CurlClient();
// $task = new Task($client);
var_dump($onfleet->verifyKey());
var_dump($onfleet->teams->get("60lbjcwT~rSeZXl~R9HtuBxP"));

// var_dump($client->authenticate("https://onfleet.com/api/v2", $config->apiKey));
