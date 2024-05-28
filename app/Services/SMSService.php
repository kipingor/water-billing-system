<?php

namespace App\Services;

use Twilio\Rest\Client;

class SMSService
{
    /**
     * The Twilio client instance.
     *
     * @var \Twilio\Rest\Client
     */
    protected $client;

    /**
     * Create a new SMSService instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->client = new Client(config('services.twilio.sid'), config('services.twilio.token'));
    }

    /**
     * Send an SMS message.
     *
     * @param  string  $to
     * @param  string  $message
     * @return void
     */
    public function sendSMS($to, $message)
    {
        $this->client->messages->create(
            $to,
            [
                'from' => config('services.twilio.from'),
                'body' => $message,
            ]
        );
    }
}