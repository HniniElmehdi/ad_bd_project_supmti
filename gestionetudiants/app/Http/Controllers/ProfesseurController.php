<?php

namespace App\Http\Controllers;

use App\Models\Professeur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfesseurController extends Controller
{
    public function index()
    {
        $professeurs = DB::select("EXEC ObtenirTousLesProfesseurs");
        return view('professeurs.index', compact('professeurs'));
    }

    public function create()
    {
        $cours = DB::select("SELECT IDCours, Titre FROM Cours");
        return view('professeurs.create', compact('cours'));
    }

    public function store(Request $request)
    {
        DB::statement("EXEC AjouterProfesseur ?, ?, ?", [
            $request->Nom,
            $request->Prénom,
            $request->IDCours
        ]);

        return redirect()->route('professeurs.index')->with('success', 'Professeur ajouté avec succès.');
    }

    public function edit($id)
    {
        $professeur = DB::selectOne("EXEC ObtenirProfesseurParID ?", [$id]);
        $cours = DB::select("SELECT IDCours, Titre FROM Cours");

        return view('professeurs.edit', compact('professeur', 'cours'));
    }

    public function update(Request $request, $id)
    {
        DB::statement("EXEC ModifierProfesseur ?, ?, ?, ?", [
            $id,
            $request->Nom,
            $request->Prénom,
            $request->IDCours
        ]);
        $prefesseur = Professeur::findOrFail($id);
        // return $prefesseur;
        User::where('IDUser', $prefesseur->IDUser)->update([
            'Nom' => $request->Nom,
            'Prénom' => $request->Prénom,
            'DateNaissance' => $request->DateNaissance,
            'Email' => $request->Email,
        ]);

        return redirect()->route('professeurs.index')->with('success', 'Professeur mis à jour avec succès.');
    }


    public function destroy($id)
    {
        $professeur = Professeur::findOrFail($id);

        $userId = $professeur->IDUser;

        DB::statement("EXEC SupprimerProfesseur ?", [$id]);

        User::where('IDUser', $userId)->delete();

        return redirect()->route('professeurs.index')->with('success', 'Professeur supprimé avec succès.');
    }
}