<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estandares extends Model
{
    use HasFactory;
    protected $table = 'estandares';
    protected $fillable = ['nombre','id_lenguaje','status'];

    public function lenguajes(){
        return $this->belongsTo('App\Models\lenguajes','id_lenguaje', 'id');
    }
}
