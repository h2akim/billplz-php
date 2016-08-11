<?php

namespace H2akim\Billplz;

use H2akim\Billplz\Bill;

class Billplz
{

    /**
     * Initial configuration
     */
    private $configuration = [
        'base_uri' => "https://www.billplz.com/api/v3/",
        'api_key' => ""
    ];

    /**
     * Constructor
     *
     * @param array $data
     */
    public function __construct($data = array())
    {
        $this->configuration['api_key'] = $data['api_key'];
    }

    /**
     * Collection method
     */
    public function collection() {
        return new Collection($this->configuration);
    }

    /**
     * Bill method
     */
    public function bill() {
        return new Bill($this->configuration);
    }

}
