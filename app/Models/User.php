<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class User extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'home_page',
    ];

    public $timestamps = true;

    protected $dateFormat = 'Y-m-d H:i:s';

    protected array $dates = ['created_at', 'updated_at'];


}
