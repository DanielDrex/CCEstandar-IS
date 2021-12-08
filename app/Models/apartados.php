<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class apartados extends Model
{
    use HasFactory;

    protected $table = 'apartados';
    protected $fillable = ['nombre','id_estandar','status'];

    public function estandares(){
        return $this->belongsTo('App\Models\estandares','id_estandar', 'id');
    }
}
