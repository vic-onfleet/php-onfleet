<?php

namespace Onfleet\Resources;

use Onfleet\Methods;

class Resources
{
    protected $_timeoutInMilliseconds = null;
    protected $api = null;
    protected $_endpoints = [];

    public function __construct($api)
    {
        $this->api = $api;
    }

    /**
     * Define the max time waiting for a response when the request is sent
     * @param int|null $timeout Max time
     */
    protected function defineTimeout($timeout = null)
    {
        $this->_timeoutInMilliseconds = $timeout ?? $this->api->api->timeout;
    }

    /**
     * Add methods into a resource according to the endpoints set
     * @param array $params Endpoints set
     */
    protected function endpoints(array $params)
    {
        $api = $this->api;
        $timeoutInMilliseconds = $this->_timeoutInMilliseconds;
        foreach ($params as $key => $value) {
            $value['timeoutInMilliseconds'] = $timeoutInMilliseconds;
            $this->{$key} = function ($args) use ($api, $value) {
                return Methods::method($value, $api, ...$args);
            };
        }
    }

    /**
     * Allows to call the different methods added
     * @param string $name Method name
     * @param array $arguments Arguments passed to the method
     * @return * Method retun
     */
    public function __call($name, $arguments)
    {
        return call_user_func($this->{$name}, $arguments);
    }
}
