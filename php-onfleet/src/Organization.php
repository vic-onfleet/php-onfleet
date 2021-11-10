<?php

namespace Onfleet;

class Organization extends Resource
{
    protected $endpoints = [
        'get' => ['method' => 'GET', 'path' => '/organizations/:orgId', 'altPath' => '/organization'],
        'insertTask' =>  ['method' => 'PUT', 'path' => '/containers/organizations/:orgId'],
    ];
}