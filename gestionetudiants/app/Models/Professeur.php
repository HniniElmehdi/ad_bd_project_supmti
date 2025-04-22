<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Professeur extends Model
{
    use HasFactory;
    protected $table = 'Professeurs';
    protected $primaryKey = 'IDProfesseur';
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

    public function departement(): BelongsTo
    {
        return $this->belongsTo(Departement::class, 'IDDépartement');
    }
}