<?php
use App\Location;
use App\LocationNumber;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('show',function(){
   $c = Location::findorfail(1);
return $a = $c->locationNumbers();
foreach($a as $b)
{
    echo $b->locationEmails();
}
});