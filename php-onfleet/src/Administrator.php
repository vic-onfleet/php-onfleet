<?php

namespace Onfleet;

class Administrator extends Resource
{
    protected $endpoints = [
        'get' => [ 'method' => 'GET', 'path' => '/admins'],
        'update' => [ 'method' => 'PUT', 'path' => '/admins'],
        'create' => [ 'method' => 'POST', 'path' => '/admins'],
        'deleteOne' => [ 'method' => 'DELETE', 'path' => '/admins']
    ];

    public function matchMetadata($obj) {}
}