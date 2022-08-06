<?php

namespace App\Http\Controllers\Api\V1\Owner;

use App\Models\Admin\Driver;
use Illuminate\Support\Carbon;
use App\Transformers\Driver\DriverProfileTransformer;
use App\Http\Controllers\Api\V1\BaseController;
use App\Models\Admin\Fleet;
use Illuminate\Http\Request;

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
        $result = Fleet::where('owner_id',auth()->user()->id)->get();

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

        $fleet = $this->fleet->create($created_params);

        return $this->respondSuccess();
    }


}
