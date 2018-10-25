<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use App\Helpers\HelperFunctions;
use Dingo\Api\Routing\Helpers;
use App\Logo;
use Carbon\Carbon;



class LocationController extends Controller
{
    use Helpers;   
    
    public function helper()
    {
        return myCall();
        return forCheck();
    }
    
    public function index()
    {
        return Logo::with(Logo::relationsLocations())->get();
    }
    
    public function store(Request $request)
    {
        
        $this->validateData($request->location, Location::validationRules($request), Location::validationMessages());
        
        // Call to location model
        return Location::store($request->location);
    }
    
    public function show($id)
    {
        
    }
    
    public function search(Request $request)
    {
        $search = $request->search;
        
        return Location::whereHas('logo', function($query) use($search){
                            $query->where(function($_query) use($search){
                            
                                foreach($search as $_search){
                                        $_query->orWhere('name','LIKE',"%$_search%");
                                }
                            })->get();
                        })
                        ;
    }
}
