<?php


namespace Yangyao\AfterShip;


use GuzzleHttp\Client;

class Notify
{
    private $endpoint = 'https://api.aftership.com/v4';
    private $client = null;

    public function __construct($apiKey)
    {
        $this->client = new Client(['headers'=>['Content-Type'=>'application/json','aftership-api-key'=>$apiKey]]);
    }

    /**
     * get notify for some tracking number
     * @param $slug
     * @param $trackingNumber
     * @return string
     */
    public function notifications($slug, $trackingNumber)
    {
        $url = $this->endpoint.'/notifications/'.$slug.'/'.$trackingNumber;
        $response = $this->client->get($url);
        return (string)$response->getBody();

    }

    /**
     * add notify email
     * @param $slug
     * @param $trackingNumber
     * @param $email
     * @return string
     */
    public function add($slug, $trackingNumber, $email)
    {
        $url = $this->endpoint.'/notifications/'.$slug.'/'.$trackingNumber.'/add';
        $response = $this->client->post($url,['form_params'=>['notification'=>[
            'emails'=>[$email]
        ]]]);
        return (string)$response->getBody();

    }

}