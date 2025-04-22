<?php

use App\Http\Controllers\CoursController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/allUsers', [UserController::class, "allUsers"]);

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/', [EtudiantController::class, 'index'])->name('etudiants.index');
Route::get('etudiants/archives', [EtudiantController::class, 'archivedStudents'])->name('etudiants.archives');
Route::get('etudiants/create', [EtudiantController::class, 'create'])->name('etudiants.create');
Route::post('etudiants', [EtudiantController::class, 'store'])->name('etudiants.store');
Route::get('/etudiants-inscrits', [EtudiantController::class, 'etudiantsInscrits'])->name('etudiants.inscrits');
Route::get('/etudiants/audit-log', [EtudiantController::class, 'auditLog'])->name('etudiants.audit');
/* assign etudiant to cour routes  */
Route::get('/etudiants/{id}/assign', [EtudiantController::class, 'showAssignForm'])->name('etudiants.assign');
Route::post('/etudiants/{id}/assign', [EtudiantController::class, 'storeAssignment'])->name('etudiants.assign.store');

/* assign etudiant to cour routes  */
Route::get('/etudiants/{id}/modifier', [EtudiantController::class, 'edit'])->name('etudiants.edit');
Route::post('/etudiants/{id}/modifier', [EtudiantController::class, 'update'])->name('etudiants.update');
Route::post('/etudiants/{id}/supprimer', [EtudiantController::class, 'destroy'])->name('etudiants.destroy');
Route::get('/etudiants/create-with-inscription', [EtudiantController::class, 'createWithInscription'])->name('etudiants.createWithInscription');
Route::post('/etudiants/store-with-inscription', [EtudiantController::class, 'storeWithInscription'])->name('etudiants.storeWithInscription');
Route::get('etudiants/{id}', [EtudiantController::class, 'show'])->name('etudiants.show');

// Route::get('/etudiants/archives', [EtudiantController::class, 'archives'])->name('etudiants.archives');




Route::get('/inscriptions/{id}/edit', [EtudiantController::class, 'etudiantsInscritsEdit'])->name('inscriptions.edit');
Route::put('/inscriptions/{id}', [EtudiantController::class, 'etudiantsInscritsUpdate'])->name('inscriptions.update');
Route::delete('/inscriptions/{id}', [EtudiantController::class, 'etudiantsInscritsDestroy'])->name('inscriptions.destroy');

/* les routes de cours  */
Route::prefix('cours')->group(function () {
    Route::get('/', [CoursController::class, 'index'])->name('cours.index');
    Route::get('/create', [CoursController::class, 'create'])->name('cours.create');
    Route::post('/', [CoursController::class, 'store'])->name('cours.store');
    Route::get('/{id}/edit', [CoursController::class, 'edit'])->name('cours.edit');
    Route::put('/{id}', [CoursController::class, 'update'])->name('cours.update');
    Route::delete('/{id}', [CoursController::class, 'destroy'])->name('cours.destroy');
});

/* le sroutes des professeurs */
Route::prefix('professeurs')->name('professeurs.')->group(function () {
    Route::get('/', [ProfesseurController::class, 'index'])->name('index');
    Route::get('/create', [ProfesseurController::class, 'create'])->name('create');
    Route::post('/', [ProfesseurController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [ProfesseurController::class, 'edit'])->name('edit');
    Route::put('/{id}', [ProfesseurController::class, 'update'])->name('update');
    Route::delete('/{id}', [ProfesseurController::class, 'destroy'])->name('destroy');
});

// Registration and Login routes
Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');