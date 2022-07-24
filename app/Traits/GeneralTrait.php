<?php

namespace App\Traits;

use App\Models\Package;
use Illuminate\Auth\Access\Gate;

trait GeneralTrait
{

    public function package($id){
        $packages =Package::find($id);

        return $packages;
    }

    public function CreateUser(){

    }
    public function idAdmin(){

        $user=auth()->user();
        if ($user->user_type == 'employee'){

            return  $user->empolyee->admin->id;

        }elseif ($user->user_type == 'representative'){

            return  $user->representative->admin->id;

        }elseif ($user->user_type == 'company'){

            return  $user->company->admin->id;

        }
        return $user->admin->id;

    }

    public function returnError($key, $value ,$errNum = "")
    {
        return response()->json([
            'status' => false,
            'errNum' => "$errNum",
            $key => $value
        ],422);
    }


    public function returnSuccessMessage($msg = "", $errNum = "S000")
    {
        return [
            'status' => true,
            'errNum' => $errNum,
            'msg' => $msg
        ];
    }

    public function returnData($key, $value, $msg = "")
    {
        return response()->json([
            'status' => true,
            'errNum' => "S000",
            'msg' => $msg,
            $key => $value
        ]);
    }

    public function returnValidationError($code = "E001", $validator)
    {
        return $this->returnError($code, $validator->errors()->first());
    }


    public function returnCodeAccordingToInput($validator)
    {
        $inputs = array_keys($validator->errors()->toArray());
        $code = $this->getErrorCode($inputs[0]);
        return $code;
    }

}


