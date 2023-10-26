<?php

namespace App\Http\Controllers;

use Mews\Captcha\Captcha;
use Illuminate\Http\Request;

class CaptchaController extends Controller
{
    public function generateCaptcha(Captcha $captcha)
    {
//        return response()->json([
//            'captcha' => $captcha->create('default', true),
//        ], 201);
        return $captcha->create('flat');
    }

}
