<?php

namespace App\Console\Commands\Fleet;

use Illuminate\Console\Command;

use App\Models\Fleet\Trip;

class GeoCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'octo:fleet-geocode';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'GeoCode current trips that are not processed';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
	    $key = 'AIzaSyB6amVMoX24LGlGcSxS2W073jojy9XZh7s';
	    $geoCoded = FALSE;
	
	    $trips = Trip::withoutGlobalScopes()->where('geoCoded', FALSE)->limit(1000)->get();
	
	    foreach ($trips as $trip) {
			$client = new \GuzzleHttp\Client();
			$startUrl = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $trip->startCoodinates[1] . ',' . $trip->startCoodinates[0] . '&key=' . $key;
			$start = $client->request('GET', $startUrl);
			$endUrl = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $trip->endCoodinates[1] . ',' . $trip->endCoodinates[0] . '&key=' . $key;
			$end = $client->request('GET', $endUrl);
		 
			$startDatas = json_decode($start->getBody())->results;
			if(!empty($startDatas)) {
				$startData = $startDatas[0];
				$trip->startAddress = $startData->formatted_address;
				$trip->startPlaceID = $startData->place_id;
				$geoCoded = TRUE;
			}
			
			$endDatas = json_decode($end->getBody())->results;
			if(!empty($endDatas)) {
				$endData = $endDatas[0];
				$trip->endAddress = $endData->formatted_address;
				$trip->endPlaceID = $endData->place_id;
				$geoCoded = TRUE;
			}
			
			$trip->geoCoded = $geoCoded;
			$trip->save();
		
		    usleep(100);
	    }
    }
}
