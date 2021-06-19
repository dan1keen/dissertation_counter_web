<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedestrian extends Model
{
    use HasFactory;
    protected $table = 'pedestrian';
    public $timestamps = false;
}
