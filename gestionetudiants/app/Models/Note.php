<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Note extends Model
{
    use HasFactory;
    protected $table = 'Notes';
    protected $primaryKey = 'IDNote';
    public $timestamps = false;

    public function inscription(): BelongsTo
    {
        return $this->belongsTo(Inscription::class, 'IDInscription');
    }
}