<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class SmsController extends Controller
{
    public function index()
    {
        return view('site.sms.index');
    }

    public function send(Request $request)
    {
        $reciverNumber = $request->mobile;

        $message = $request->message;

        try {

            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");

            $client = new Client($account_sid, $auth_token);
            $client->messages->create($reciverNumber, [
                'from' => $twilio_number,
                'body' => $message
            ]);

            dd('message sent succcessfuly');
        } catch(Exception $e) {
            dd("Error: ". $e->getMessage());
        }
    }
}

