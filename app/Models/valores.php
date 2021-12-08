<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class valores extends Model
{   

    use HasFactory;
    protected $table = 'valores';
    protected $fillable = ['caracteres','valor','tipo_valor','id_regla','status'];

    public function reglas(){
        return $this->belongsTo('App\Models\reglas','id_regla', 'id');
    }
}
