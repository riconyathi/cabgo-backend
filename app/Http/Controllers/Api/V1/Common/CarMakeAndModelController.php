<?php

namespace App\Http\Controllers\Api\V1\Common;

use App\Models\Master\CarMake;
use App\Models\Master\CarModel;
use App\Http\Controllers\Api\V1\BaseController;
use Carbon\Carbon;
use Kreait\Firebase\Database;

/**
 * @group Vehicle Management
 *
 * APIs for vehilce management apis. i.e types,car makes,models apis
 */
class CarMakeAndModelController extends BaseController
{
    protected $car_make;
    protected $car_model;

    public function __construct(CarMake $car_make, CarModel $car_model,Database $database)
    {
        $this->car_make = $car_make;
        $this->car_model = $car_model;
        $this->database = $database;
    }


     public function sortByDistance($a, $b) {
        return $a['distance'] - $b['distance'];
    }

    /**
    * Get All Car makes
    *
    */
    public function getCarMakes()
    {

        $current_time = $current_time = Carbon::now();

        $trip_requested_time = Carbon::now()->subMinutes(3);

        dd($trip_requested_time->diffInMinutes($current_time));

        // $this->database->getReference('request-meta/2')->update(['has_ride'=>1,'approve'=>1,'updated_at'=> Database::SERVER_TIMESTAMP]);

        // $this->database->getReference('request-meta/2')->remove();
        
        return $this->respondSuccess($this->car_make->active()->orderBy('name')->get());
    }

   

    /**
    * Get Car models by make id
    * @urlParam make_id  required integer, make_id provided by user
    */
    public function getCarModels($make_id)
    {
        return $this->respondSuccess($this->car_model->where('make_id', $make_id)->active()->orderBy('name')->get());
    }
}
