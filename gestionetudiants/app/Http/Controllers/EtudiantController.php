<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EtudiantController extends Controller
{
    public function index()
    {
        $etudiants = DB::select('SELECT * FROM Vue_Etudiants');
        return view('etudiants.index', ['etudiants' => $etudiants]);
    }
    public function show($id)
    {
        $etudiant = DB::select('SELECT * FROM Etudiants WHERE IDEtudiant = ?', [$id]);
        if (empty($etudiant)) {
            return response()->json(['message' => 'Student not found'], 404);
        }
        return response()->json($etudiant);
    }

    public function create()
    {
        return view("etudiants.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nom' => 'required|string|max:100|min:3',
            'Prénom' => 'required|string|max:100',
            'DateNaissance' => 'required|date',
            'Email' => 'required|email|unique:Etudiants',
        ]);

        DB::statement('EXEC AjouterEtudiant ?, ?, ?, ?', [
            $request->Nom,
            $request->Prénom,
            $request->DateNaissance,
            $request->Email
        ]);

        return redirect()->route('etudiants.index')->with('success', 'Étudiant ajouté avec succès via procédure stockée.');
    }

    public function edit($id)
    {
        $etudiant = DB::selectOne("SELECT * FROM Etudiants WHERE IDEtudiant = ?", [$id]);
        return view('etudiants.edit', ['etudiant' => $etudiant]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'Nom' => 'required|string|max:100',
            'Prénom' => 'required|string|max:100',
            'DateNaissance' => 'required|date',
            'Email' => 'required|email|unique:Etudiants,Email,' . $id . ',IDEtudiant',
        ]);

        DB::statement('EXEC ModifierEtudiant ?, ?, ?, ?, ?', [
            $id,
            $request->Nom,
            $request->Prénom,
            $request->DateNaissance,
            $request->Email
        ]);
        $etudiant = Etudiant::findOrFail($id);
        // return $etudiant;
        User::where('IDUser', $etudiant->IDUser)->update([
            'Nom' => $request->Nom,
            'Prénom' => $request->Prénom,
            'DateNaissance' => $request->DateNaissance,
            'Email' => $request->Email,
        ]);

        return redirect()->route('etudiants.index')->with('success', 'Étudiant mis à jour avec succès.');
    }

    public function archivedStudents()
    {

        $archives = DB::select("
        SELECT * FROM ArchivesEtudiants
        ORDER BY IDArchive DESC
    ");


        return view('etudiants.archives', compact('archives'));
    }

    public function createWithInscription()
    {
        $cours = DB::select("SELECT IDCours, Titre FROM Cours");
        return view('etudiants.create_with_inscription', compact('cours'));
    }

    // Handle form
    public function storeWithInscription(Request $request)
    {
        DB::statement("EXEC AjouterEtudiantAvecInscription
        @Nom = ?,
        @Prénom = ?,
        @DateNaissance = ?,
        @Email = ?,
        @IDCours = ?",
            [
                $request->Nom,
                $request->Prénom,
                $request->DateNaissance,
                $request->Email,
                $request->IDCours
            ]
        );

        return redirect()->route('etudiants.inscrits')->with('success', "Étudiant ajouté et inscrit avec succès !");
    }

    public function etudiantsInscrits()
    {
        $etudiants = DB::select('SELECT * FROM vue_etudiants_inscrits');
        // return $etudiants;
        return view('etudiants.inscrits', ['etudiants' => $etudiants]);
    }

    public function etudiantsInscritsDestroy($id)
    {
        DB::delete("DELETE FROM Inscriptions WHERE IDInscription = ?", [$id]);

        return redirect()->route('etudiants.inscrits')->with('success', 'Inscription supprimée avec succès.');
    }

    public function etudiantsInscritsEdit($id)
    {
        $inscription = DB::selectOne("SELECT * FROM vue_etudiants_inscrits WHERE IDInscription = ?", [$id]);

        $etudiants = DB::select("SELECT IDEtudiant, Nom, Prénom FROM Etudiants");
        $cours = DB::select("SELECT IDCours, Titre FROM Cours");

        return view('etudiants.inscrits_edit', compact('inscription', 'etudiants', 'cours'));
    }


    public function etudiantsInscritsUpdate(Request $request, $id)
    {
        DB::update("UPDATE Inscriptions SET IDEtudiant = ?, IDCours = ?, DateInscription = ? WHERE IDInscription = ?", [
            $request->IDEtudiant,
            $request->IDCours,
            $request->DateInscription,
            $id
        ]);

        return redirect()->route('etudiants.inscrits')->with('success', 'Inscription mise à jour avec succès.');
    }



    public function destroy($id)
    {
        $etudiant = Etudiant::findOrFail($id);

        // Get User ID before deletion
        $userId = $etudiant->IDUser;
        DB::statement('EXEC SupprimerEtudiant ?', [$id]);
        User::where('IDUser', $userId)->delete();

        return redirect()->route('etudiants.index')->with('success', 'Étudiant supprimé avec succès.');
    }


    public function auditLog()
    {
        $logs = DB::select('SELECT * FROM AuditLog ORDER BY Timestamp DESC');
        return view('etudiants.audit', compact('logs'));
    }



    public function showAssignForm($idEtudiant)
    {
        $etudiant = DB::selectOne('SELECT * FROM Etudiants WHERE IDEtudiant = ?', [$idEtudiant]);

        $availableCours = DB::select("
        SELECT * FROM Cours
        WHERE IDCours NOT IN (
            SELECT IDCours FROM Inscriptions WHERE IDEtudiant = ?
        )
    ", [$idEtudiant]);

        return view('etudiants.assign', compact('etudiant', 'availableCours'));
    }

    public function storeAssignment(Request $request, $idEtudiant)
    {
        $request->validate([
            'IDCours' => 'required|integer'
        ]);

        DB::statement('EXEC AssignerEtudiantCours ?, ?', [
            $idEtudiant,
            $request->IDCours
        ]);

        return redirect()->route('etudiants.index')->with('success', 'Cours assigné avec succès.');
    }




}