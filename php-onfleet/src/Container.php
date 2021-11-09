<?php

namespace Onfleet;

class Container extends Resource
{
    protected $endpoints = [
        'get' => ['method' => 'GET', 'path' => '/containers'],
        'update' => ['method' => 'PUT', 'path' => '/containers']
    ];
}