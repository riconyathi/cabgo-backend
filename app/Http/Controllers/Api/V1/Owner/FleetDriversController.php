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
use App\Base\Services\ImageUploader\ImageUploaderContract;
use Kreait\Firebase\Database;
use App\Models\User;
use App\Base\Constants\Auth\Role;


class FleetDriversController extends BaseController
{
    protected $driver;
    protected $fleet;
    protected $imageUploader;
    protected $database;


    public function __construct(Driver $driver,Fleet $fleet,Database $database,ImageUploaderContract $imageUploader,User $user)
    {
        $this->driver = $driver;

        $this->fleet = $fleet;

        $this->database = $database;
        
        $this->imageUploader = $imageUploader;

        $this->user = $user;
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
     * Add Driver
     * 
     * 
     * */
    public function addDriver(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile'=>'required',
            'address'=>'required|min:10',
            'profile'=>'required'
        ]);

        $owner_detail = auth()->user()->owner;


        $profile_picture = null;

        if ($uploadedFile = $this->getValidatedUpload('profile', $request)) {
            $profile_picture = $this->imageUploader->file($uploadedFile)
                ->saveDriverProfilePicture();
        }


        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'mobile' => $request->mobile,
            'mobile_confirmed' => true,
            'timezone'=>auth()->user()->timezone,
            'country'=>auth()->user()->country,
            'profile_picture'=>$profile_picture,
            'refferal_code'=>str_random(6),
        ]);

        $user->attachRole(Role::DRIVER);

        $created_params = $request->only(['name','mobile','email','address']);

        $created_params['service_location_id'] = $owner_detail->service_location_id;

        $driver = $user->driver()->create($created_params);

         $this->database->getReference('drivers/'.$driver->id)->set(['id'=>$driver->id,'vehicle_type'=>null,'active'=>0,'updated_at'=> Database::SERVER_TIMESTAMP]);

        return $this->respondSuccess(null,'driver_added_succesfully');

    }

    

}
