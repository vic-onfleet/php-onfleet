<?php

namespace Onfleet;

class Container extends Resource
{
    protected $endpoints = [
        'get' => ['method' => 'GET', 'path' => '/containers/:param/:containerId']
    ];
}