<?php

namespace H2akim\Billplz;

class Bill
{

    private $request_type = 'bills';

    private $configuration;
    public $params;
    private $channel;
    private $data = [];

    public function __construct($configuration) {
        $this->configuration = $configuration;
    }

    public function create($data = array())
    {
        $this->channel = curl_init($this->configuration['base_uri'].$this->request_type);
        if (!array_key_exists('object', $data)) $data['object'] = false;
        $this->data = $data;
        return ($data['object']) ? json_decode($this->sendRequest()) : $this->sendRequest();
    }

    public function get($data = array())
    {
        $this->channel = curl_init($this->configuration['base_uri'].$this->request_type.'/'.$data['bill_id']);
        if (!array_key_exists('object', $data)) $data['object'] = false;
        $result = $this->sendRequest();
        if (array_key_exists('auto_submit', $data)) {
            $result = json_decode($result);
            $result->url = $result->url.'?auto_submit='.$data['auto_submit'];
            $result = json_encode($result);
        }
        return ($data['object']) ? json_decode($result) : $result;
    }

    public function delete($data = array())
    {
        $this->channel = curl_init($this->configuration['base_uri'].$this->request_type.'/'.$data['bill_id']);
        if (!array_key_exists('object', $data)) $data['object'] = false;
        curl_setopt($this->channel, CURLOPT_CUSTOMREQUEST, 'DELETE');
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
