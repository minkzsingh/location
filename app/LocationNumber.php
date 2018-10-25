<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Location;

class LocationNumber extends Model
{
    protected $fillable = ['mobile_numbers','phone_numbers','fax_numbers'];
    
    protected $hidden = ['created_at','updated_at','deleted_at'];
    
    // Relationships
    public function location()
    {
        return $this ->belongsTo(Location::class);
    }
    
    // End Relations
    
    public static function store($request,$location)
    {
        // Create Loop For Save Multiple Addresses
        foreach($request as $_request){
                $numbers = new LocationNumber();
                $numbers->fill($_request);
                $numbers->location()->associate($location)->save();
        }
    }
}
