<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Notification extends Model
{
    protected $fillable = ['type'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public static function store($request)
    {
        $notification = new Notification();
        $notification->fill($request);
        $notification->user()->associate($request["user"]["id"]);
        
        $notification->save();
        
        return $notification;
    }
    
    public static function filter($request)
    {
        if($request["user_id"] && $request["type"] && $request != null){
            return Notification::where('user_id',$request["user_id"])
                                ->where('type',$request["type"])
                                ->get();
        }
        else{
            return 'not found';
        }
    }
}
