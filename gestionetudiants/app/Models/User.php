<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    // Specify the table name
    protected $table = 'Users';
    public $timestamps = false;

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'Nom',
        'Prénom',
        'Email',
        'DateNaissance',
        'MotDePasse',
        'user_role',
        'DateCréation'
    ];

    // Set the primary key for the table (IDUser)
    protected $primaryKey = 'IDUser';

    // Hide the password field when the user is fetched
    protected $hidden = [
        'MotDePasse',
    ];

    // Specify that the ID should be treated as an integer (not auto-incrementing)
    public $incrementing = true;

    // Define any relationships, if needed
    public function etudiant()
    {
        return $this->hasOne(Etudiant::class, 'IDUser');
    }

    public function professeur()
    {
        return $this->hasOne(Professeur::class, 'IDUser');
    }
}