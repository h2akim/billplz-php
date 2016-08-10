<?php

namespace H2akim\Billplz;

class Collection
{

    private $request_type = 'collections';
    private $configuration;
    private $data = [];

    public function __construct($configuration)
    {
        $this->configuration = $configuration;
    }

    public function create($data = array())
    {
        $this->channel = curl_init($this->configuration['base_uri'].$this->request_type);
        if (!array_key_exists('object', $data)) $data['object'] = false;
        $this->data = $data;
        return ($data['object']) ? json_decode($this->sendRequest()) : $this->sendRequest();
    }

    public function createOpen($data = array())
    {
        $this->channel = curl_init($this->configuration['base_uri'].'open_'.$this->request_type);
        if (!array_key_exists('object', $data)) $data['object'] = false;
        $this->data = $data;
        return ($data['object']) ? json_decode($this->sendRequest()) : $this->sendRequest();
    }

    private function sendRequest() {
		curl_setopt($this->channel, CURLOPT_USERPWD, $this->configuration['api_key'] . ":");
		curl_setopt($this->channel, CURLOPT_TIMEOUT, 30);
		curl_setopt($this->channel, CURLOPT_RETURNTRANSFER, TRUE);
		if (count($this->data) > 0) {
			curl_setopt($this->channel, CURLOPT_POSTFIELDS, $this->data );
		}
		$result = curl_exec($this->channel);
		curl_close($this->channel);
        return $result;
    }
}
