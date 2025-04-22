<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Inscription extends Model
{
    use HasFactory;
    protected $table = 'Inscriptions';
    protected $primaryKey = 'IDInscription';
    public $timestamps = false;

    public function etudiant(): BelongsTo
    {
        return $this->belongsTo(Etudiant::class, 'IDEtudiant');
    }

    public function cours(): BelongsTo
    {
        return $this->belongsTo(Cours::class, 'IDCours');
    }

    public function note(): HasOne
    {
        return $this->hasOne(Note::class, 'IDInscription');
    }
}