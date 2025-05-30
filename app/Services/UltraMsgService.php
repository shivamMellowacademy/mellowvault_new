<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class UltraMsgService
{
    public function sendMessage($to, $message)
    {
        $response = Http::get("https://api.ultramsg.com/" . config('services.ultramsg.instance_id') . "/messages/chat", [
            'token' => config('services.ultramsg.token'),
            'to' => $to, // Format: 919876543210
            'body' => $message,
        ]);

        return $response->json();
    }
}
