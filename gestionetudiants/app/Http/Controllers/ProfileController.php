<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'Email' => 'sometimes|email|unique:Users,Email,' . $user->IDUser . ',IDUser',
            'MotDePasse' => 'nullable|string|min:8|confirmed',
        ]);

        // ✅ Check if current password is correct
        if (!Hash::check($request->current_password, $user->MotDePasse)) {
            return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }

        $data = [];

        if ($request->filled('Email')) {
            $data['Email'] = $request->Email;
        }

        if ($request->filled('MotDePasse')) {
            $data['MotDePasse'] = Hash::make($request->MotDePasse);
        }

        // ✅ Update Users table
        if (!empty($data)) {
            User::where('IDUser', $user->IDUser)->update($data);

            // ✅ Reflect Email change in corresponding table
            if (isset($data['Email'])) {
                if ($user->user_role === 'etudiant') {
                    \App\Models\Etudiant::where('IDUser', $user->IDUser)->update(['Email' => $data['Email']]);
                } elseif ($user->user_role === 'professeur') {
                    \App\Models\Professeur::where('IDUser', $user->IDUser)->update(['Email' => $data['Email']]);
                }
            }
        }

        return redirect()->route('profile.show')->with('success', 'Profil mis à jour avec succès.');
    }
}