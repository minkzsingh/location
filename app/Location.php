<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\Logo;
use App\LocationEmail;
use App\LocationNumber;
use App\LocationAddress;
use Carbon\Carbon;

class Location extends Model
{
    protected $fillable  = ['name'];
    
    protected $hidden = ['created_at','updated_at','deleted_at'];
    
    // Relationships
    public function locationAddresses()
    {
        return $this ->HasMany(LocatioAddress::class);
    }
    
    public function locationNumbers()
    {
        return $this ->HasMany(LocatioNumber::class);
    }
    
    public function locationEmails()
    {
        return $this ->HasMany(LocatioEmail::class);
    }
    
    public function logo()
    {
        return $this->belongsTo(Logo::class);    
    }
    
    // End Relations
    
    public static function relations()
    {
        return ['logo'];
    }
    
    // Associate Relaationships
    public function associativeRelations($request)
    {
        // Emails
        if($request["emails"]){
            LocationEmail::store($request["emails"],$this);
        }
        else{
            $this->locationEmails()->delete();
        }
        
        //Numbers
        if($request["numbers"]){
            LocationNumber::store($request["numbers"],$this);
        }
        else{
            $this->locationNumbers()->delete();
        }
        
        // Addresses
        if($request["addresses"]){
            LocationAddress::store($request["addresses"],$this);
        }
        else{
            $this->locationAddresses()->delete();
        }
    }
    
    // Validations
    public static function validationMessages()
    {
        $messages = [''];
    }
    
    
    public static function validationRules($request)
    {
        $rules = [
                    'name' =>[ 'required','min:4', 'max:255' ]
                ];
        return $rules;
    }
    
    // Crud
    public static function store($request)
    {
        // Create A Object Of Location Model
        $location = new Location();
        $logo = Logo::store($request["logo"]);
    
        $location->fill($request);
        $location->time = Carbon::now();
        
        $location->logo()->associate($logo)->save();
        
        // Save Relationships
        $location->associativeRelations($request, $location);
    }
}
