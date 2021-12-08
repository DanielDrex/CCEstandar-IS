<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reglas extends Model
{
    use HasFactory;

    protected $table = 'reglas';
    protected $fillable = ['nombre','id_apartado','tipo_regla','posicion','status'];

    public function apartados(){
        return $this->belongsTo('App\Models\apartados','id_apartado', 'id');
    }
}
