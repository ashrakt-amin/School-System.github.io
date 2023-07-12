<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Http;


trait ZoomTrait
{

    public static function getToken()
    {
        $accessToken = session('zoom_access_token');
        if ($accessToken == null) {
            $accessToken = self::authfromZoom();
            $accessToken = session('zoom_access_token');

        }
        
        return  $accessToken;
    }

    public static function authfromZoom()
    {
        $query = http_build_query([
            'response_type' => 'code',
            'client_id'     => env('ZOOM_CLIENT_ID'),
            'redirect_uri'  => url('zoom/callback'),
        ]);

        $url = "https://zoom.us/oauth/authorize?$query";

        return redirect($url);
    }


    public function token($request)
    {

        $response = Http::asForm()->post('https://zoom.us/oauth/token', [
            'grant_type' => 'authorization_code',
            'code' => $request->input('code'),
            'refresh_token' => session('zoom_refresh_token'),
            'client_id' => env('ZOOM_CLIENT_ID'),
            'client_secret' => env('ZOOM_CLIENT_SECRET'),
            'redirect_uri' => env('ZOOM_REDIRECT_URI'),
        ]);

        $accessToken = $response->json()['access_token'];

        session(['zoom_access_token' => $accessToken]);



        return $accessToken;
    }


    public function user()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->authZoom(),
        ])->get('https://api.zoom.us/v2/users/me');

        $user = $response->json();
        return $user;
    }

    public function createMeeting($request)
    {
       // return $this->getToken();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->getToken(),
        ])->post("https://api.zoom.us/v2/users/me/meetings", [
            'topic' => $request->topic,
            'type' => 2, // scheduled meeting
            'start_time' => $request->start_time,
            'duration' => $request->duration,
            'timezone' => config('zoom.timezone'),
            'password' => $request->password,

        ]);
        //return $accessToken;

        $meeting = $response->json();
        return $meeting;
        // }else{
        //    return $this->authZoom();
        // }
    }


    public function deleteMeeting($meetingId)
    {
        $accessToken = self::getToken();
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->delete("https://api.zoom.us/v2/meetings/$meetingId");

        if ($response->status() === 204) {
            return 'Meeting deleted successfully.';
        } else {
            return 'Failed to delete meeting.';
        }
    }
}
