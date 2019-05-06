<?php

namespace Yangyao\AfterShip;


use GuzzleHttp\Client;

class Tracking{

    private $endpoint = 'https://api.aftership.com/v4';
    private $client = null;

    public function __construct($apiKey)
    {
        $this->client = new Client(['headers'=>['Content-Type'=>'application/json','aftership-api-key'=>$apiKey]]);
    }

    /**
     * create a tracking
     * @param $trackingNumber
     * @return string
     */
    public function create($trackingNumber)
    {
        $url = $this->endpoint.'/trackings';
        $response = $this->client->post($url,['form_params'=>['tracking_number'=>$trackingNumber,'tracking'=>['slug'=>'dhl','tracking_number'=>$trackingNumber]]]);
        return (string)$response->getBody();
    }

    /**
     * delete a tracking
     * @param $slug
     * @param $trackingNumber
     * @return string
     */
    public function delete($slug,$trackingNumber)
    {
        $url = $this->endpoint.'/trackings/'.$slug.'/'.$trackingNumber;
        $response = $this->client->delete($url);
        return (string)$response->getBody();
    }

    /**
     * return couriers list
     * @return string
     */
    public function couriers()
    {
        $url = $this->endpoint . '/couriers';
        $response = $this->client->get($url);
        return (string)$response->getBody();
    }

}