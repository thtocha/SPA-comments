<?php

namespace App\Http\Controllers;

use Mews\Captcha\Captcha;
use Illuminate\Http\Request;

class CaptchaController extends Controller
{
    public function generateCaptcha(Captcha $captcha)
    {
        return response()->json([
            'captcha' => $captcha->create('default', true),
        ], 201);
    }

    public function verifyCaptcha(Request $request, Captcha $captcha)
    {
        $this->validate($request, [
            'captcha' => 'required|captcha_api:' . $request->input('captcha_id'),
        ]);

        return response()->json(['message' => 'Captcha verification passed'], 201);
    }
}
