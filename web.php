<?php

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
use Illuminate\Http\Request;
Route::get('/getAll', function (Request $req) {
        header('Access-Control-Allow-Origin:*');
       $items = App\Item::all();
    return $items;
});
Route::get('/getFound', function (Request $req) {
        header('Access-Control-Allow-Origin:*');
       $items = App\Item::where("status",1)->get();
        
    return $items;
});
Route::get('/getLost', function (Request $req) {
        header('Access-Control-Allow-Origin:*');
       $items = App\Item::where("status",0)->get();
        
    return $items;
});
Route::get('/searchAll', function (Request $req) {
        header('Access-Control-Allow-Origin:*');
        
    $okay = App\Item::where('title', $req->search)
    ->orWhere('description', 'like', '%' . $req->search . '%')->orWhere('title', 'like', '%' . $req->search . '%')->get();
    return $okay;
});
Route::get('/makefound', function (Request $req) {
    header('Access-Control-Allow-Origin:*');
    DB::table('items')->insert([
        "title"=>$req->stitle,
        "description"=>$req->sdesc,
        "contact"=>$req->scontact,
        "status"=>$req->sstatus,
        "solution"=>0,
    ]);
});