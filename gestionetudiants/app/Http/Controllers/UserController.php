<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Professeur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // Validate input data
        $validated = $request->validate([
            'Nom' => 'required|string|max:255',
            'Prénom' => 'required|string|max:255',
            'Email' => 'required|email|unique:Users',
            'DateNaissance' => 'required',
            'MotDePasse' => 'required|string|min:8|confirmed',
        ]);

        // Create the user
        $userId = User::insertGetId([
            'Nom' => $request->Nom,
            'Prénom' => $request->Prénom,
            'DateNaissance' => $request->DateNaissance,
            'Email' => $request->Email,
            'MotDePasse' => bcrypt($request->MotDePasse), // Hash password
            'user_role' => $request->user_role, // You can set default 'etudiant' or allow it to be passed
        ]);



        // Optionally, create linked profile (etudiant or professeur) if needed
        if ($request->user_role === 'etudiant') {
            Etudiant::create([
                'Nom' => $request->Nom,
                'Prénom' => $request->Prénom,
                'DateNaissance' => $request->DateNaissance,
                'Email' => $request->Email,
                'IDUser' => $userId,
            ]);
        } elseif ($request->user_role === 'professeur') {
            Professeur::create([
                'Nom' => $request->Nom,
                'Prénom' => $request->Prénom,
                'DateNaissance' => $request->DateNaissance,
                'Email' => $request->Email,
                'IDUser' => $userId,
            ]);
        }

        // Authenticate the user and log them in
        // Auth::login($user);

        return redirect()->route('etudiants.index');
    }

    public function login(Request $request)
    {
        // Validate login data
        $validated = $request->validate([
            'Email' => 'required|email',
            'MotDePasse' => 'required|string',
        ]);

        // Check if the user exists
        $user = User::where('Email', $request->Email)->first();

        if ($user && Hash::check($request->MotDePasse, $user->MotDePasse)) {
            // Log the user in
            Auth::login($user);
            return redirect()->route('etudiants.index');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }
    public function showLoginForm()
    {
        return view("auth.login");
    }
    public function showRegisterForm($type = "etudiant")
    {
        return view("auth.register", compact('type'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }


    public function allUsers()
    {
        return User::all();
    }

}