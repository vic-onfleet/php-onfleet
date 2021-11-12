<?php

namespace Onfleet;

class Administrator extends Resource
{
    protected $endpoints = [
        'get' => [ 'method' => 'GET', 'path' => '/admins'],
        'update' => [ 'method' => 'PUT', 'path' => '/admins/:adminId'],
        'create' => [ 'method' => 'POST', 'path' => '/admins'],
        'deleteOne' => [ 'method' => 'DELETE', 'path' => '/admins/:adminId'],
        'matchMetadata' => ['method' => 'POST', 'path' => '/admins/metadata']
    ];

    public function matchMetadata($obj) {}
}