<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable=[
        'menu_id',
        'menu_name',
        'image',
        'price',
        'publish_status',
        'waiting_time',
        'description'

    ];
    use HasFactory;
}
