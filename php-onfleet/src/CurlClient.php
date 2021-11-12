<?php

namespace Onfleet;

class CurlClient
{
    /**
     * Authentication checker
     * @param string $url Onfleet API URLl
     * @param string $key Onfleet API Key
     * @return boolean
     */
    public function authenticate(string $baseUrl, string $key): bool
    {
        $result = $this->execute(
            "{$baseUrl}/auth/test",
            'GET',
            ['Authorization: Basic ' . base64_encode("{$key}:")]
        );
        return $result['code'] == 200;
    }

    /**
     * Calls an HTTP API and returns the data given
     *
     * @param string $url API URL
     * @param string $method Method to be used in the request
     * @param array $headers Request headers
     * @param array $params Params to be sent
     * @param int|null $timeOut Max execution time
     * @return array
     */
    public function execute(
        string $url,
        string $method = 'GET',
        array $headers = [],
        array $params = [],
        int $timeOut = 0
    ): array {
        $this->_client = curl_init();
        curl_setopt($this->_client, CURLOPT_URL, $url);

        // Default configuration
        curl_setopt($this->_client, CURLOPT_SSL_VERIFYHOST, 1);
        curl_setopt($this->_client, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($this->_client, CURLOPT_RETURNTRANSFER, 1);

        if (is_int($timeOut) && $timeOut > 0) {
            curl_setopt($this->_client, CURLOPT_TIMEOUT, 1);
        }

        if ($headers) {
            curl_setopt($this->_client, CURLOPT_HTTPHEADER, $headers);
        }

        if ($method === 'POST') {
            curl_setopt($this->_client, CURLOPT_POST, 1);
        } else if (in_array($method, ['PUT', 'PATCH', 'DELETE'])) {
            curl_setopt($this->_client, CURLOPT_CUSTOMREQUEST, $method);
        }

        if (!empty($params) && in_array($method, ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            if ($params) curl_setopt($this->_client, CURLOPT_POSTFIELDS, json_encode($params));
        }

        $result = curl_exec($this->_client);
        if ($result === false) {
            throw new \Exception("Connection couldn't be established.");
        }

        $httpCode = curl_getinfo($this->_client, CURLINFO_HTTP_CODE);
        $success = ($httpCode >= 200 && $httpCode < 300);
        $result = json_decode($result, true);
        $response = [
            'success' => $success,
            'code' => curl_getinfo($this->_client, CURLINFO_HTTP_CODE),
            'data' => $success ? $result : null,
            'error' => !$success ? $result : null,
        ];

        curl_close($this->_client);
        return $response;
    }
}
