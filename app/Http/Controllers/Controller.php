<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Dingo\Api\Exception\StoreResourceFailedException;
use Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function validateData($request, $rules)
    {
        //Customer validation
        $validator = Validator::make($request, $rules);
        
        if ($validator->fails()) {
            throw new StoreResourceFailedException('Could not create new record.', $validator->errors());
        }
    }
}
