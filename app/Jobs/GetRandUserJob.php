<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use App\Services\ApiHandler;

class GetRandUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $api_handler;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->api_handler = new ApiHandler();
    }

    /**
     * Execute the job.
     * 
     * todo: add job fail handling
     * @return void
     */
    public function handle()
    {
        //get data from api
        $rand_user_data = $this->api_handler->getRandUserDataFromApi();
        $rand_user_data = $rand_user_data['results'];


        //Calculate the mean and median
        //get age only
        foreach($rand_user_data as $row){
            $age[] = $row['dob']['age'];
        }

        //transform array to laravel collection
        $age = collect($age);

        //mean
        $mean = $age->avg();

        //media
        $median = $age->median();

        //join all data
        $data = [
            "mean" => $mean, 
            "median" => $median,
            "data" => $rand_user_data
        ];

        //caching
        //generate unique id 
        $cache_id = now();
        //Overcome jobs that are running at the same time
        $cache_id = strtotime($cache_id) . Str::random(5);

        Cache::put('getranduser_'.$cache_id, $data);
    }
}
