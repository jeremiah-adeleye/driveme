<?php


namespace App\Http\Service;


use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class TwilioService{

    private $sid;
    private $auth_token;
    private $number;
    private $client;

    public function __construct(){
        $this->sid = env('TWILIO_SID');
        $this->auth_token = env('TWILIO_AUTH_TOKEN');
        $this->number = env('TWILIO_NUMBER');
        try {
            $this->client = new Client($this->sid, $this->auth_token);
        } catch (ConfigurationException $e) {
        }
    }

    public function sendMessage($to, $message) {
        try {
            $this->client->messages->create($this->formatNumber($to), [
                'from' => $this->number,
                'body' => $message
            ]);
        } catch (TwilioException $e) {
            //todo add to pending messages
        }
    }

    private function formatNumber($number) {
        if (strlen($number) <= 10) {
            return $this->getCountryCode() . $number;
        }else {
            return substr($this->getCountryCode(), -10) . $number;
        }
    }

    private function getCountryCode() {
        return '+234';
    }
}
