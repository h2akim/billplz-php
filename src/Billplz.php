<?php

namespace H2akim\Billplz;

use H2akim\Billplz\Bill;

class Billplz
{

    private $configuration = [
        'base_uri' => "https://www.billplz.com/api/v3/",
        'api_key' => ""
    ];

    /**
     * Constructor
     *
     * @param
     */
    public function __construct($data = array())
    {
        $this->configuration['api_key'] = $data['api_key'];
    }

    public function collection()
    {

        return new Collection($this->configuration);
    }

    public function bill($bill = false)
    {
        return new Bill($this->configuration, $bill);
    }

}
