<?php

namespace App\Http\Controllers\Api\V1\Common;

use App\Models\Master\CarMake;
use App\Models\Master\CarModel;
use App\Http\Controllers\Api\V1\BaseController;
use Sk\Geohash\Geohash;
use Kreait\Firebase\Database;
use Carbon\Carbon;

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
        // $g = new Geohash();
            
        // $requested_lat = 11.06398;
        // $requested_long = 76.9053006;

        // $radius = 15;

        // $calculatable_radius = ($radius/2);

        // $calulatable_lat = 0.0144927536231884 * $calculatable_radius;
        // $calulatable_long = 0.0181818181818182 * $calculatable_radius;

        // $lower_lat = ($requested_lat - $calulatable_lat);
        // $lower_long = ($requested_long - $calulatable_long);

        // $higher_lat = ($requested_lat + $calulatable_lat);
        // $higher_long = ($requested_long + $calulatable_long);

        // $lower_hash = $g->encode($lower_lat,$lower_long, 12);
        // $higher_hash = $g->encode($higher_lat,$higher_long, 12);


        // $conditional_timestamp = Carbon::now()->subMinutes(7)->timestamp;

        // $vehicle_type = '5fcfe2a8-a3d7-437e-81c0-54ebb575fc02';

        // $fire_drivers = $this->database->getReference('drivers')->orderByChild('g')->startAt($lower_hash)->endAt($higher_hash)->getValue();

        // $firebase_drivers = [];

        // $i=-1;

        // foreach ($fire_drivers as $key => $fire_driver) {
        //     $i +=1; 
        //     $driver_updated_at = Carbon::createFromTimestamp($fire_driver['updated_at'] / 1000)->timestamp;

        //     if($fire_driver['vehicle_type']==$vehicle_type && $fire_driver['is_active']==1 && $fire_driver['is_available']==1 && $conditional_timestamp < $driver_updated_at){

                

        //     }  

        //     $distance = distance_between_two_coordinates($requested_lat,$requested_long,$fire_driver['l'][0],$fire_driver['l'][1],'K');

        //         $firebase_drivers[$fire_driver['id']]['distance']= $distance;    

        // }

        // asort($firebase_drivers);

        //  $nearest_driver_ids = [];

        // foreach ($firebase_drivers as $key => $firebase_driver) {
                    
        //             $nearest_driver_ids[]=$key;
        // }

        // dd($nearest_driver_ids);

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
