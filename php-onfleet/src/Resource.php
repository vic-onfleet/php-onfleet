<?php

namespace Onfleet;

class Resource
{
    protected $endpoints = [
        'get' => ['method' => 'GET', 'path' => ''],
        'update' => ['method' => 'PUT','path' => ''],
        'create' => ['method' => 'POST','path' => ''],
        'deleteOne' => ['method' => 'DELETE', 'path' => '']
    ];
    protected $client;

    public function __construct($client) {
        $this->client = $client;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    public function create($data) {}

    public function update($id, $data) {}

    public function deleteOne($id) {}

    public function get($id) {}

    public function insertTask($id, $obj) {}

    public function matchMetadata($obj) {}
}