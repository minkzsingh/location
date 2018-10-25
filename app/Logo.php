<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Location;

class Logo extends Model
{
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'deleted_at','updated_at'];
    // Relationships
    public function locations()
    {
        return $this ->HasMany(Location::class);
    }
    
    // End Relations
    
    public static function relationsLocations()
    {
        return ['locations'];
    }
    
    public static function store($request, $logo = null)
    {
        
        if(isset($request) && $request != null)
        {
        if($logo === null){
                $logo = new Logo();
            }
            
            $logo->fill($request)->save();
            
            return $logo;
        }
    }
}
