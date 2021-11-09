<?php

namespace Onfleet;

class Worker extends Resource
{
    protected $endpoints = [
        'create' =>  ['method' => 'GET', 'path' => '/workers'],
        'get' => ['method' => 'GET', 'path' => '/workers/:workerId',
            'altPath' => '/workers', 'queryParams' => true ],
        'getByLocation' => ['method' => 'GET', 'path' => '/workers/location',
            'altPath' => '/workers/location', 'queryParams' => true ],
        'update' => ['method' => 'PUT', 'path' => '/workers/:workerId'],
        'deleteOne' => [ 'method' => 'DELETE', 'path' => '/workers/:workerId'],
        'insertTask' =>  ['method' => 'PUT', 'path' => '/containers/workers/:workerId'],
        'getSchedule' =>  ['method' => 'GET', 'path' => '/workers/:workerId/schedule'],
        'setSchedule' => ['method' => 'POST', 'path' => '/workers/:workerId/schedule'],
        'matchMetadata' => ['method' => 'POST', 'path' => '/workers/metadata']
    ];

    public function __construct($client)
    {
        parent::__construct($client);
    }

    public function getByLocation($obj) {}

    public function getSchedule($id) {}

    public function setSchedule($id, $obj) {}

    public function matchMetadata($obj) {}
}