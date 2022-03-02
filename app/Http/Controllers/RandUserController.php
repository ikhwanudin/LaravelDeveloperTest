<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\GetRandUserJob;

class RandUserController extends Controller
{

    
    public function index()
    {
        // GetRandUserJob::dispatch()->onQueue('get_rand_user_queue');

        // return 'queue running';        
    }
}
