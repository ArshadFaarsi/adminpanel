<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        return $request;
    }


    public function login(Request $request)
    {

        return $request;
    }



    public function logout()
    {

        return 'logout';
    }




    public function notification()
    {
        $SERVER_API_KEY = 'AAAAGAYvVyg:APA91bHn703e-8w6gHludk4Wd8Uj1HjFXYp6933n-ZQx-a8qM_Hu86nJh-XlVv7CBUXikcOICEN1TW4sswuAjjeD7RWaCwttgE3R26ZvLGdwkIgHR9HigoxyZusqQucp-i5vdjyqWww8';
        $data = [
            'to' => 'fyRn1eGwRiKUYISE1ePZoU:APA91bEmN9xAvoZpjfcumQ7hvlcG-gFVWaE9vUh8XpobiA5dFKxGHhCxVP8jwHm-VD_gpb1EATIGth3f-WsXvhMmQry6hkCYwRROMZmUO21ghOxcoGm8xulSKkLKLZw3YA-bH_qPnzic',
            'notification' => [
                'title' => "Request",
                'body' => 'asdnsajkldnsalkdmnsakdmsamsadmsadms',
            ],
        ];

        $dataString = json_encode($data);
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        $response = curl_exec($ch);
        dd($response);
    }
}
