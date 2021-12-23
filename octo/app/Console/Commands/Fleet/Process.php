<?php

namespace App\Console\Commands\Fleet;

use Illuminate\Console\Command;

use App\Models\Fleet\Fleet;
use App\Models\Fleet\GpsRawData;
use App\Models\Fleet\Trip;

class Process extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hello:fleet-process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
	    $vehicles = Fleet::withoutGlobalScopes()->get();

        foreach($vehicles as $vehicle) {
            $rawDatas = GpsRawData::withoutGlobalScopes()
                ->where('device_id', $vehicle->deviceID)
                ->whereNotIn('processed', [1, 2])
                ->where('command', 'LOGIN')
                ->orderBy('acc_on')
                ->orderBy('packageTime')
                ->get();
            $rawDatasCount = count($rawDatas);

            if ($rawDatasCount > 0) {
                $count = 0;

                foreach ($rawDatas as $rawData) {
                    $count++;

                    // Not going to process the last login since more data might come in future
                    if ($count < $rawDatasCount) {
                        $tripDatas = GpsRawData::withoutGlobalScopes()
                            ->where('device_id', $rawData->device_id)
                            ->where('processed', '!=', 1)
                            ->where('acc_on', $rawData->acc_on)
                            ->where('command', 'GPS_DATA')
	                        ->orderBy('utc_time')
                            ->get();

                        if (count($tripDatas) > 0) {
                            $logout = GpsRawData::withoutGlobalScopes()
                                ->where('device_id', $rawData->device_id)
                                ->where('processed', '!=', 1)
                                ->where('acc_on', $rawData->acc_on)
                                ->where('command', 'LOGOUT')
                                ->first();

                            $lastRecord = !empty($logout) ? $logout : $tripDatas->last();

                            $trip = new Trip();
                            $trip->oid = $vehicle->oid;
                            $trip->fleetID = $vehicle->id;
                            $trip->deviceID = $vehicle->deviceID;
                            $trip->vehicleName = $vehicle->vehicleName;
                            $trip->startTime = $rawData->utc_time;
                            $trip->startCoodinates = array($rawData->long, $rawData->lat);
                            $trip->endTime = $lastRecord->utc_time;
                            $trip->endCoodinates = array($lastRecord->long, $lastRecord->lat);
                            $trip->tripMileage = $lastRecord->currentTripMileage;
                            $trip->fuelConsumption = $lastRecord->currentTripFuelConsumption;
                            $trip->geoCoded = FALSE;
                            $trip->save();
	
	                        GpsRawData::withoutGlobalScopes()->where('device_id', $rawData->device_id)
                                ->where('processed', '!=', 1)
                                ->where('acc_on', $rawData->acc_on)
                                ->where('command', 'GPS_DATA')
                                ->update([
                                    'trip_id' => $trip->_id,
                                    'processed' => 1
                                ]);

                            $rawData->trip_id = $trip->_id;
                            $rawData->processed = 1;
                            $rawData->save();

                            $lastRecord->trip_id = $trip->_id;
                            $lastRecord->processed = 1;
                            $lastRecord->save();
                        } else {
                            // This is probably not a trip since no data points between login and logout.
                            // May be a sleep ping?
                            $rawData->processed = 2;
                            $rawData->save();
                        }
                        
                        unset($tripDatas, $logout, $lastRecord, $trip);
                    }
                }
            }
        }
    }
}
