<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client as Google_Client;
use Google\Service\Calendar as Google_Service_Calendar;
use App\Services\GoogleCalendarService;

class GoogleCalendarController extends Controller
{
    protected $googleCalendarService;

    public function __construct(GoogleCalendarService $googleCalendarService)
    {
        $this->googleCalendarService = $googleCalendarService;
    }

    // Redirect to Google OAuth for authentication
    public function redirectToGoogle()
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $client->addScope(Google_Service_Calendar::CALENDAR);
        $client->setAccessType('offline');
        $client->setPrompt('consent');

        $authUrl = $client->createAuthUrl();
        return redirect($authUrl);
    }

    // Handle the Google OAuth callback and save the access token
    public function handleGoogleCallback(Request $request)
    {
        $client = new \Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $client->addScope(\Google_Service_Calendar::CALENDAR);
    
        // Fetch the access token using the code
        $token = $client->fetchAccessTokenWithAuthCode($request->code);
    
        if (isset($token['error'])) {
            return redirect('/')->with('error', 'Google Calendar authentication failed.');
        }
    
        // Save token using the service
        $calendarService = new GoogleCalendarService();
        $calendarService->saveAccessToken($token);
    
        return redirect('resource')->with('success', 'Google Calendar connected successfully');
    }

}
