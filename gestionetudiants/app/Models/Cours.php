<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cours extends Model
{
    use HasFactory;
    protected $table = 'Cours';
    protected $primaryKey = 'IDCours';
    public $timestamps = false;

    public function inscriptions(): HasMany
    {
        return $this->hasMany(Inscription::class, 'IDCours');
    }
}