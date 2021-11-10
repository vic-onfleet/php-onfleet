<?php

namespace Onfleet;

class Hub extends Resource
{
    protected $endpoints = [
        'create' => [ 'method' => 'POST', 'path' => '/hubs'],
        'get' => ['method' => 'GET', 'path' => '/hubs'],
        'update' => ['method' => 'PUT', 'path' => '/hubs/:hubId'],
    ];
}