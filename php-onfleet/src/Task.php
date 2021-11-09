<?php
namespace Onfleet;


class Task extends Resource {

    protected $endpoints = [
        'create' => [ 'method' => 'POST', 'path' => '/tasks'],
        'get' => ['method' => 'GET', 'path' => '/tasks/:taskId',
            'altPath' => '/tasks/all', 'queryParams' => true ],
        'update' => ['method' => 'PUT', 'path' => '/tasks/:taskId'],
        'deleteOne' => [ 'method' => 'DELETE', 'path' => '/tasks/:taskId'],
        'clone' => ['method' => 'POST', 'path' => '/tasks/:taskId/clone'],
        'forceComplete' => ['method' => 'POST', 'path' => '/tasks/:taskId/complete'],
        'batchCreate' => ['method' => 'POST', 'path' => '/tasks/batch'],
        'autoAssign' => ['method' => 'POST', 'path' => '/tasks/autoAssign'],
        'matchMetadata' => ['method' => 'POST', 'path' => '/tasks/metadata']
    ];


    public function __construct($client)
    {
        parent::__construct($client);
    }

    public function clone($id) {}

    public function forceComplete($id) {}
    public function batch($obj) {}
    public function autoAssign($obj){}
    public function matchMetadata($obj) {}
}