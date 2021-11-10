<?php

namespace Onfleet;

class Destination extends Resource
{
    protected $endpoints = [
        'create' => [ 'method' => 'POST', 'path' => '/destinations'],
        'get' => ['method' => 'GET', 'path' => '/destinations/:destinationId'],
        'matchMetadata' => ['method' => 'POST', 'path' => '/destinations/metadata']
    ];
}