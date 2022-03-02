<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiHandler{

    private $base_path = 'https://randomuser.me';

    /**
     * Get Random User Data from Api
     * 
     * @return object
     */

    public function getRandUserDataFromApi()
    {
        $endpoint = $this->base_path . '/api/?results=20';

        //automatically retry the request if a client or server error occurs
        $response = Http::retry(3, 100, function($exception){
            return $exception instanceof ConnectionException;
        })->get($endpoint);

        //add throw() if client or server error

        //convert response to object
        $response = $response->json();

        return $response;
    }
}