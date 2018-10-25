<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Location;

class LocationAddress extends Model
{
    protected $fillable = [
                'type',
                'line_1',
                'line_2',
                'line_3',
                'line_4',
                'line_5',
                'city',
                'state',
                'country',
                'pincode'
                ];
    
    protected $hidden = ['created_at','updated_at','deleted_at'];
    
    // Relationships
    public function location()
    {
        return $this ->belongsTo(Location::class);
    }
    
    //End Relations
    
    public static function store($request,$location)
    {
        // Create Loop For Save Multiple Addresses
        foreach($request as $_request){
            $address = new LocationAddress();
            $address->fill($_request);
            $address->location()->associate($location)->save();
        }
    }
}
