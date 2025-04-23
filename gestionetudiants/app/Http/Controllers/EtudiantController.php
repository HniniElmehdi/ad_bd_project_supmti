<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EtudiantController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $column = $request->input('column', 'Nom'); // default to 'Nom'

        $allowedColumns = ['Nom', 'Prénom', 'Email'];
        if (!in_array($column, $allowedColumns)) {
            $column = 'Nom'; // fallback protection
        }

        if ($search) {
            $query = "SELECT * FROM Vue_Etudiants WHERE $column LIKE ?";
            $etudiants = DB::select($query, ["%$search%"]);
        } else {
            $etudiants = DB::select('SELECT * FROM Vue_Etudiants');
        }

        return view('etudiants.index', [
            'etudiants' => $etudiants,
            'search' => $search,
            'column' => $column
        ]);
    }


    public function show($id)
    {
        $etudiant = DB::select('SELECT * FROM Etudiants WHERE IDEtudiant = ?', [$id]);
        if (empty($etudiant)) {
            return response()->json(['message' => 'Student not found'], 404);
        }
        return response()->json($etudiant);
    }

    // public function create()
    // {
    //     return view("etudiants.create");
    // }

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

    public function archivedStudents(Request $request)
    {
        $search = $request->input('search');
        $column = $request->input('column', 'Nom');

        $allowedColumns = ['Nom', 'Prénom', 'Email', 'DateSuppression'];
        if (!in_array($column, $allowedColumns)) {
            $column = 'Nom';
        }

        if ($search) {
            $query = "SELECT * FROM ArchivesEtudiants WHERE $column LIKE ? ORDER BY IDArchive DESC";
            $archives = DB::select($query, ["%$search%"]);
        } else {
            $archives = DB::select("SELECT * FROM ArchivesEtudiants ORDER BY IDArchive DESC");
        }

        return view('etudiants.archives', [
            'archives' => $archives,
            'search' => $search,
            'column' => $column
        ]);
    }


    // public function createWithInscription()
    // {
    //     $cours = DB::select("SELECT IDCours, Titre FROM Cours");
    //     return view('etudiants.create_with_inscription', compact('cours'));
    // }

    // // Handle form
    // public function storeWithInscription(Request $request)
    // {
    //     DB::statement("EXEC AjouterEtudiantAvecInscription
    //     @Nom = ?,
    //     @Prénom = ?,
    //     @DateNaissance = ?,
    //     @Email = ?,
    //     @IDCours = ?",
    //         [
    //             $request->Nom,
    //             $request->Prénom,
    //             $request->DateNaissance,
    //             $request->Email,
    //             $request->IDCours
    //         ]
    //     );

    //     return redirect()->route('etudiants.inscrits')->with('success', "Étudiant ajouté et inscrit avec succès !");
    // }

    public function etudiantsInscrits(Request $request)
    {
        $search = $request->input('search');
        $column = $request->input('column', 'NomEtudiant');

        $allowedColumns = [
            'NomEtudiant',
            'PrénomEtudiant',
            'Email',
            'TitreCours'
        ];

        if (!in_array($column, $allowedColumns)) {
            $column = 'NomEtudiant';
        }

        if ($search) {
            $query = "SELECT * FROM vue_etudiants_inscrits WHERE $column LIKE ? ORDER BY DateInscription DESC";
            $etudiants = DB::select($query, ["%$search%"]);
        } else {
            $etudiants = DB::select('SELECT * FROM vue_etudiants_inscrits ORDER BY DateInscription DESC');
        }

        return view('etudiants.inscrits', [
            'etudiants' => $etudiants,
            'search' => $search,
            'column' => $column
        ]);
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


    public function auditLog(Request $request)
    {
        $search = $request->input('search');
        $column = $request->input('column', 'Action');

        $allowedColumns = ['Action', 'TableName', 'Details'];
        if (!in_array($column, $allowedColumns)) {
            $column = 'Action';
        }

        if ($search) {
            $query = "SELECT * FROM AuditLog WHERE $column LIKE ? ORDER BY Timestamp DESC";
            $logs = DB::select($query, ["%$search%"]);
        } else {
            $logs = DB::select("SELECT * FROM AuditLog ORDER BY Timestamp DESC");
        }

        return view('etudiants.audit', [
            'logs' => $logs,
            'search' => $search,
            'column' => $column
        ]);
    }




    public function showAssignForm($idEtudiant)
    {
        $etudiant = DB::selectOne('SELECT * FROM Etudiants WHERE IDEtudiant = ?', [$idEtudiant]);

        if(auth()->user()->user_role === 'professeur'){
            $availableCours = DB::select("
        SELECT * FROM Cours c, Professeurs p
        WHERE c.IDCours = p.IDCours  AND p.IDCours NOT IN (
            SELECT IDCours FROM Inscriptions WHERE IDEtudiant = ?
        )
    ", [$idEtudiant]);

        }else{


            $availableCours = DB::select("
            SELECT * FROM Cours
            WHERE IDCours NOT IN (
                SELECT IDCours FROM Inscriptions WHERE IDEtudiant = ?
                )
                ", [$idEtudiant]);
        }

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


    public function dashboard()
    {
        $userId = auth()->user()->IDUser;
        // Assuming there's a matching étudiant record
        $etudiant = DB::table('Etudiants')->where('IDUser', $userId)->first();

        if (!$etudiant) {
            abort(403, 'Non autorisé.');
        }

        $cours = DB::select("
        SELECT *
        FROM vue_etudiants_inscrits
        WHERE IDEtudiant = ?
    ", [$etudiant->IDEtudiant]);

        return view('etudiants.dashboard', compact('cours'));
    }




}