<?php

namespace App\Services;

use Carbon\Carbon;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
use App\Models\GoogleToken;

class GoogleCalendarService
{
    protected $client;

    public function __construct()
    {
        // Initialize the Google_Client instance
        $this->client = new Google_Client();
        $this->client->setClientId(env('GOOGLE_CLIENT_ID'));
        $this->client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $this->client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $this->client->setAccessType('offline');
        $this->client->setApprovalPrompt('force');
        $this->client->setScopes([
            'https://www.googleapis.com/auth/calendar',
            'https://www.googleapis.com/auth/calendar.events'
        ]);

        // Load access token from DB (if exists)
        $googleToken = GoogleToken::latest()->first();
        if ($googleToken) {
            // Set the access token to the Google Client
            $this->client->setAccessToken([
                'access_token' => $googleToken->access_token,
                'refresh_token' => $googleToken->refresh_token,
                'expires_in' => $googleToken->expires_in,
                'scope' => $googleToken->scope,
                'token_type' => $googleToken->token_type,
            ]);

            // If the access token has expired, refresh it
            if ($this->client->isAccessTokenExpired()) {
                $newToken = $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
                $this->saveAccessToken($newToken);
                $this->client->setAccessToken($newToken);
            }
        }
    }

    /**
     * Save the access token to the database
     * 
     * @param array $token
     */
    public function saveAccessToken($token)
    {
        GoogleToken::updateOrCreate([], [
            'access_token' => $token['access_token'],
            'refresh_token' => $token['refresh_token'],
            'expires_in' => $token['expires_in'],
        ]);
    }

    /**
     * Create an interview event in Google Calendar
     * 
     * @param string $name
     * @param string $email
     * @param string $date
     * @return string $meetLink
     */
    public function createInterviewEvent($name, $email, $date)
    {
        $service = new Google_Service_Calendar($this->client);

// If $date already includes time (e.g., '2025-05-04T06:30'), use Carbon directly
$startDateTime = Carbon::parse($date)->toRfc3339String(); // Example: '2025-05-04T10:00:00'
$endDateTime = Carbon::parse($date)->addMinutes(30)->toRfc3339String(); // Add 30 minutes for end time


        // Create the event details
        $event = new Google_Service_Calendar_Event([
            'summary' => 'Interview with ' . $name,
            'description' => 'Scheduled interview with ' . $name,
            'start' => [
                'dateTime' => $startDateTime,
                'timeZone' => 'Asia/Kolkata',
            ],
            'end' => [
                'dateTime' => $endDateTime,
                'timeZone' => 'Asia/Kolkata',
            ],
            'attendees' => [
                ['email' => $email],
            ],
            'conferenceData' => [
                'createRequest' => [
                    'requestId' => uniqid(),
                    'conferenceSolutionKey' => ['type' => 'hangoutsMeet'],
                ],
            ],
        ]);

        // Insert the event into the calendar and create the Google Meet link
        $createdEvent = $service->events->insert('primary', $event, ['conferenceDataVersion' => 1]);

        return $createdEvent->getHangoutLink(); // Return the Google Meet link
    }
}
