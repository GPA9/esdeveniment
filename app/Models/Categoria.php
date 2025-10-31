<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{

    protected $fillable = ['nom'];

    public function esdeveniments()
    {
        return $this->hasMany(Esdeveniment::class, 'categoria_id');
    }
}
