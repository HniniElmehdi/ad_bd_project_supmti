<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Etudiant extends Model
{
    use HasFactory;
    protected $table = 'Etudiants';
    protected $primaryKey = 'IDEtudiant';
    public $timestamps = false;
    protected $fillable = [
        'Nom',
        'Prénom',
        'DateNaissance',
        'Email',
        'IDCours',
        'DateInscription',
        'IDUser'
        // Add other columns here as needed
    ];


    public function inscriptions(): HasMany
    {
        return $this->hasMany(Inscription::class, 'IDEtudiant');
    }
}