<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CaptchaRequest;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Http\Request;

class CaptchasController extends Controller
{
    //
    public function store(CaptchaRequest $request,CaptchaBuilder $captchaBuilder)
    {
        $key = "captcha-".str_random(15);
        $phone = $request->phone;

        $captch = $captchaBuilder->build();
        $expireAt = now()->addMinutes(10);
        $code = $captch->getPhrase();
        \Cache::put($key,['phone'=>$phone,'code'=>$code,],$expireAt);

        $result = [
            'captch_key'=>$key,
            'expire_at'=>$expireAt,
            'code'=>$code,
            'captch_image_content'=>$captch->inline()
        ];

        return $this->response->array($result)->setStatusCode(201);
    }
}
