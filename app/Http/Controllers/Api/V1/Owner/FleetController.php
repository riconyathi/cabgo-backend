<?php

namespace App\Http\Controllers\Api\V1\Owner;

use App\Models\Admin\Driver;
use Illuminate\Support\Carbon;
use App\Transformers\Driver\DriverProfileTransformer;
use App\Http\Controllers\Api\V1\BaseController;
use App\Models\Admin\Fleet;
use Illuminate\Http\Request;
use App\Transformers\Driver\DriverTransformer;
use App\Transformers\Owner\FleetTransformer;

class FleetController extends BaseController
{
    protected $driver;
    protected $fleet;


    public function __construct(Driver $driver,Fleet $fleet)
    {
        $this->driver = $driver;

        $this->fleet = $fleet;
    }

    /**
    * List Fleets
    * @group Fleet-Owner-apis
    * @return \Illuminate\Http\JsonResponse
    * @responseFile responses/driver/Online-OfflineResponse.json
    * @responseFile responses/driver/DriverOfflineResponse.json
    */
    public function index()
    {
        $fleets = Fleet::where('owner_id',auth()->user()->id)->get();

        $result = fractal($fleets, new FleetTransformer);

        return $this->respondSuccess($result,'fleet_listed');
    }


    /**
     * Store Fleets
     * 
     * 
     * */
    public function storeFleet(Request $request){

        $created_params = $request->only(['vehicle_type','car_color']);

        $created_params['brand'] = $request->car_make;
        $created_params['model'] = $request->car_model;
        $created_params['license_number'] = $request->car_number;
        $created_params['owner_id'] = auth()->user()->id;

        $fleet = $this->fleet->create($created_params);

        return $this->respondSuccess();
    }



    /**
     * List Drivers For Assign Drivers
     * 
     * 
     * */
    public function listDrivers()
    {
        $owner_id = auth()->user()->owner->id;

        $drivers = Driver::where('owner_id',$owner_id)->get();

        $result = fractal($drivers, new DriverTransformer);

        return $this->respondOk($result);

    }

    /**
     * Assign Drivers
     * 
     * 
     * */
    public function assignDriver(Request $request,Fleet $fleet)
    {
        $driver = Driver::whereId($request->driver_id)->first();
        
        if($fleet->driverDetail){

            $fleet->driverDetail()->update(['fleet_id'=>null,'vehicle_type'=>null]);

        }

        $fleet->update(['driver_id'=>$request->driver_id]);


        $driver->update([
            'fleet_id' => $fleet->id,
            'vehicle_type' => $fleet->vehicle_type
        ]);


        return $this->respondSuccess();
        
    }


}
