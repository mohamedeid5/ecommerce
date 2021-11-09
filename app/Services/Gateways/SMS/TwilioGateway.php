<?php

namespace App\Services\Gateways\SMS;

use Exception;
use Twilio\Rest\Client;

class TwilioGateway {

    /**
     * Method send
     *
     * @param $phone
     * @param $message
     *
     * @return void
     */
    public function send($phone, $message)
    {
        try {

            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");

            // send code to mobile
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($phone, [
                'from' => $twilio_number,
                'body' => $message,
            ]);

        } catch(Exception $e) {

            dd("Error: ". $e->getMessage());
        }
    }
}
