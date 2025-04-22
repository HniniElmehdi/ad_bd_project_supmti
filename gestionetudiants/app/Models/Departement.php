<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Departement extends Model
{
    use HasFactory;
    protected $table = 'Departements';
    protected $primaryKey = 'IDDépartement';
    public $timestamps = false;

    public function professeurs(): HasMany
    {
        return $this->hasMany(Professeur::class, 'IDDépartement');
    }
}