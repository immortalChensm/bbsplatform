<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
$api = app('Dingo\Api\Routing\Router');

//$api->version('v1', function($api) {
//    $api->get('version', function() {
//        return response('this is version v1');
//    });
//});
//
//$api->version('v2', function($api) {
//    $api->get('version', function() {
//        return response('this is version v2');
//    });
//});

$api->version("v1",[
    "namespace"=>"App\Http\Controllers\Api"
],function($api){


    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config("api.rate_limits.limit"),
        'expires' => config("api.rate_limits.expires"),
    ], function($api) {

        // 短信验证码VerificationCodesController
        $api->post('verificationCodes', 'VerificationCodesController@store')
            ->name('api.verificationCodes.store');

        $api->post('users', 'UsersController@store')
            ->name('api.users.store');

        $api->post('captchas', 'CaptchasController@store')->name('api.captchas.store');

        $api->post('authorizations', 'AuthorizationsController@store')
            ->name('api.authorizations.store');
    });

});