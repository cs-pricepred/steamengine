<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use SteamApi\Configs\Apps;
use SteamApi\SteamApi;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('test', function(Request $request) {
    $api = new SteamApi();
    /* $options = [ */
    /*     'market_hash_name' => "AK-47 | Slate (Field-Tested)" */
    /* ]; */
    /* return $api->detailed()->getItemPricing(730, $options); */

    /* $options = [ */
    /* 'market_hash_name' => "AK-47 | Slate (Field-Tested)", */
    /* 'item_name_id' => 176241017, */
    /* 'country' => 'US',                                    //optional */
    /* 'language' => 'english',                              //optional */
    /* 'currency' => 3,                                      //optional */
    /* 'two_factor' => 0                                     //optional */
    /* ]; */

    /* return $api->detailed()->getItemOrdersHistogram(Apps::CSGO_ID, $options); */

    $options = [
    'market_hash_name' => "AK-47 | Slate (Field-Tested)"
    ];

    return $api->detailed()->getSaleHistory(Apps::CSGO_ID, $options);
});
