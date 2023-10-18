<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'parent_id',
        'text',
    ];

    public $timestamps = true;

    // Указываем формат даты и времени
    protected $dateFormat = 'Y-m-d H:i:s';

    // Определяем, какие поля являются датами
    protected $dates = ['created_at', 'updated_at'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
