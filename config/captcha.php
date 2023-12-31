<?php

return [
    'secret' => env('NOCAPTCHA_SECRET'),
    'sitekey' => env('NOCAPTCHA_SITEKEY'),
    'disable' => env('CAPTCHA_DISABLE', false),
    'characters' => ['2','3','4','5','6','7','8','9','a','b','c','d','e','f','g','h','j','m','n','p','q','r',
                     't','u','x','y','z','A','B','C','D','E','F','G','H','J','M','N','P','Q','R','T','U','X','Y','Z'],
    'default'   => [
        'length'    => 6,
        'width'     => 120,
        'height'    => 36,
        'quality'   => 90,
        'math'      => true,
        'expire'    => 60,
    ],
    'options' => [
        'timeout' => 30,
    ],
    'flat' => [
        'length' => 6,
        'width' => 160,
        'height' => 46,
        'quality' => 90,
        'lines' => 6,
        'bgColor' => '#ecf2f4',
        'fontColors' => ['#2c3e50', '#c0392b', '#16a085', '#c0392b', '#8e44ad', '#303f9f', '#f57c00', '#795548',],
    ],
];
