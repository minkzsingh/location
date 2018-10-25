<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Location;

class LocationEmail extends Model
{
    protected $fillable = ['emails_type','emails'];
    
    protected $hidden = ['created_at','updated_at','deleted_at'];
    
    // Relationships
    public function location()
    {
        return $this ->belongsTo(Location::class);
    }
    
    // End Relations
    
    public static function store($request,$location)
    {
        // Create Loop For Save Multiple Emails
        foreach($request as $_request){
            $emails = new LocationEmail();
            $emails->fill($_request);
            $emails->location()->associate($location)->save();
        }
    }
}
