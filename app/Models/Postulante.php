<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulante extends Model
{
    use HasFactory;
    protected $fillable = ['phone', 'name', 'paterno', 'materno', 'address', 'postal', 'tdatos', 'email', 'document'];

    public function aplication()
    {
        return $this->hasMany(Application::class);
    }

}
