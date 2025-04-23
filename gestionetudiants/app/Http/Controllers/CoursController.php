<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoursController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $column = $request->input('column', 'Titre');

        $allowedColumns = ['Titre', 'Crédit'];

        if (!in_array($column, $allowedColumns)) {
            $column = 'Titre';
        }

        if ($search) {
            $cours = DB::select("SELECT * FROM Cours WHERE $column LIKE ?", ['%' . $search . '%']);
        } else {
            $cours = DB::select("SELECT * FROM Cours");
        }

        return view('cours.index', compact('cours', 'search', 'column'));
    }



    public function create()
    {
        return view('cours.create');
    }

    public function store(Request $request)
    {
        DB::statement("EXEC AjouterCours ?, ?", [
            $request->Titre,
            $request->Crédit
        ]);

        return redirect()->route('cours.index')->with('success', 'Cours ajouté avec succès.');
    }

    public function edit($id)
    {
        $cours = DB::selectOne("EXEC ObtenirCoursParID ?", [$id]);

        if (!$cours) {
            return redirect()->route('cours.index')->with('error', 'Cours introuvable.');
        }

        return view('cours.edit', compact('cours'));
    }

    public function update(Request $request, $id)
    {
        DB::statement("EXEC ModifierCours ?, ?, ?", [
            $id,
            $request->Titre,
            $request->Crédit
        ]);

        return redirect()->route('cours.index')->with('success', 'Cours mis à jour avec succès.');
    }

    public function destroy($id)
    {
        DB::statement("EXEC SupprimerCours ?", [$id]);

        return redirect()->route('cours.index')->with('success', 'Cours supprimé avec succès.');
    }
}