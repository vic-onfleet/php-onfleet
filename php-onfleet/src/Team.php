<?php

namespace Onfleet;

class Team extends Resource {

    protected $endpoints = [
        'create' => [ 'method' => 'POST', 'path' => '/teams'],
        'get' => [ 'method' => 'GET', 'path' => '/teams/:teamId', 'altPath' => '/teams' ],
        'update' => [ 'method' => 'PUT', 'path' => '/teams/:teamId'],
        'deleteOne' => [ 'method' => 'DELETE', 'path' => '/teams/:teamId'],
        'insertTask' =>  ['method' => 'PUT', 'path' => '/containers/teams/:teamId'],
        'autoDispatch' =>  [ 'method' => 'POST', 'path' => '/teams/:teamId/dispatch'],
        'getWorkerEta' => [ 'method' => 'GET', 'path' => '/teams/:teamId/estimate', 'queryParams' => true]
    ];

    public function __construct($client)
    {
        parent::__construct($client);
    }

    public function getWorkerEta($id, $obj) {}

    public function autoDispatch($id, $obj) {}

    public function insertTask($id, $obj) {}
}