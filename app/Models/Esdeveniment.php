<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Esdeveniment extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 'data', 'hora', 'descripcio', 'imatge', 'num_max_assistents', 'num_reserves', 'edat_minima', 'categoria_id'
    ]; 

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    
    public function usuaris()
    {
        return $this->belongsToMany(User::class, 'user_esdeveniment', 'esdev_id', 'user_id')->withTimestamps();
    }

    // Mètode auxiliar per contar les reserver
    public function reservaContador() 
    {
        return $this->usuaris()->count();
    }

    // Mètode auxiliar per calcular quantes entrades estan disponibles
    public function seientsDisponibles() 
    {
        return $this->num_max_assistents - $this->reservaContador(); // calculo les entrades disponibles restant el nombre de reserves.
    }
}