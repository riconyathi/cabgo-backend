<?php

namespace App\Http\Controllers\Api\V1\Common;

use App\Models\Master\CarMake;
use App\Models\Master\CarModel;
use App\Http\Controllers\Api\V1\BaseController;
use App\Models\Admin\ZoneSurgePrice;
use Illuminate\Support\Carbon;

/**
 * @group Vehicle Management
 *
 * APIs for vehilce management apis. i.e types,car makes,models apis
 */
class CarMakeAndModelController extends BaseController
{
    protected $car_make;
    protected $car_model;

    public function __construct(CarMake $car_make, CarModel $car_model)
    {
        $this->car_make = $car_make;
        $this->car_model = $car_model;
    }

    /**
    * Get All Car makes
    *
    */
    public function getCarMakes()
    {


        // $timezone = env('SYSTEM_DEFAULT_TIMEZONE');

        // $current_time = Carbon::now()->setTimezone($timezone);

        // $current_time = $current_time->toTimeString();

        // $zone_surge_price = ZoneSurgePrice::whereTime('start_time','<=',$current_time)->whereTime('end_time','>=',$current_time)->first();


        return $this->respondSuccess($this->car_make->get());
    }

    /**
    * Get Car models by make id
    * @urlParam make_id  required integer, make_id provided by user
    */
    public function getCarModels($make_id)
    {
        return $this->respondSuccess($this->car_model->where('make_id', $make_id)->get());
    }
}
