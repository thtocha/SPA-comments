<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_id',
        'file_name',
        'file_path',
        'file_type',
    ];

    public $timestamps = true;

    protected $dateFormat = 'Y-m-d H:i:s';

    protected array $dates = ['created_at', 'updated_at'];


}
