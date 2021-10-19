<?php

namespace App\Services;

use App\Services\Gateways\SMS\TwilioGateway;

class SMSGatewayService {

    protected $twilio;

    public function __construct(TwilioGateway $twilio)
    {
        $this->twilio = $twilio;
    }

    public function send($phone, $message)
    {
        $this->twilio->send($phone, $message);
    }
}
