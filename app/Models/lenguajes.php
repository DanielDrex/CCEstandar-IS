<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lenguajes extends Model
{
    use HasFactory;

    protected $table = 'lenguajes';
    protected $fillable = ['nombre','extension','status'];


}
