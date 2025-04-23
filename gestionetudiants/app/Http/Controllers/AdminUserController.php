<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $column = $request->input('column');

        $validColumns = ['Nom', 'Prénom', 'Email'];

        if ($search && in_array($column, $validColumns)) {
            $users = DB::select("SELECT * FROM Users WHERE $column LIKE ?", ["%$search%"]);
        } else {
            $users = DB::select('SELECT * FROM Users');
        }

        return view('users.index', compact('users', 'search', 'column'));
    }


    public function edit($id)
    {
        $user = DB::selectOne('SELECT * FROM Users WHERE IDUser = ?', [$id]);

        if (!$user) {
            abort(404);
        }

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Nom' => 'required|string|max:100',
            'Prénom' => 'required|string|max:100',
            'Email' => 'required|email|unique:Users,Email,' . $id . ',IDUser',
            'DateNaissance' => 'required|date',
            'user_role' => 'required|in:admin,professeur,etudiant',
        ]);

        DB::update('
            UPDATE Users
            SET Nom = ?, Prénom = ?, Email = ?, DateNaissance = ?, user_role = ?
            WHERE IDUser = ?
        ', [
            $request->Nom,
            $request->Prénom,
            $request->Email,
            $request->DateNaissance,
            $request->user_role,
            $id
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function showResetPasswordForm($id)
    {
        // Generate random 10-character password
        $newPassword = Str::random(10);

        $user = DB::selectOne("SELECT * FROM Users WHERE IDUser = ?", [$id]);

        if (!$user) {
            return redirect()->route('admin.users.index')->with('error', 'Utilisateur introuvable.');
        }

        return view('users.reset-password', [
            'user' => $user,
            'generatedPassword' => $newPassword,
        ]);
    }


    public function resetPassword(Request $request, $id)
    {
        $request->validate([
            'new_password' => 'required|string|min:8',
        ]);

        $hashed = Hash::make($request->new_password);

        DB::update('UPDATE Users SET MotDePasse = ? WHERE IDUser = ?', [$hashed, $id]);

        return redirect()->route('admin.users.index')->with('success', 'Mot de passe réinitialisé avec succès.');
    }
}