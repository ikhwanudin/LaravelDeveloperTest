<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\GetRandUserJob;

class RandUserController extends Controller
{

    // run manual job
    
    public function index()
    {
        // GetRandUserJob::dispatch()->onQueue('get_rand_user_queue');

        // return 'queue running';        
    }
}
