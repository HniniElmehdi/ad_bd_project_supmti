<?php

use App\Http\Controllers\AdminUserController;
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



Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('etudiant/dashboard', [EtudiantController::class, 'dashboard'])->name('etudiant.dashboard')->middleware('role:etudiant');
});

Route::get('/etudiants', [EtudiantController::class, 'index'])->name('etudiants.index')->middleware('role:admin,professeur');

Route::get('etudiants/archives', [EtudiantController::class, 'archivedStudents'])->name('etudiants.archives')->middleware('role:admin');
// Route::get('etudiants/create', [EtudiantController::class, 'create'])->name('etudiants.create');
Route::post('etudiants', [EtudiantController::class, 'store'])->name('etudiants.store')->middleware('role:admin');
Route::get('/etudiants-inscrits', [EtudiantController::class, 'etudiantsInscrits'])->name('etudiants.inscrits')->middleware('role:admin');
Route::get('/etudiants/audit-log', [EtudiantController::class, 'auditLog'])->name('etudiants.audit')->middleware('role:admin');

/* assign etudiant to cour routes  */
Route::get('/etudiants/{id}/assign', [EtudiantController::class, 'showAssignForm'])->name('etudiants.assign')->middleware('role:admin,professeur');
Route::post('/etudiants/{id}/assign', [EtudiantController::class, 'storeAssignment'])->name('etudiants.assign.store')->middleware('role:admin,professeur');

/* assign etudiant to cour routes  */
Route::get('/etudiants/{id}/modifier', [EtudiantController::class, 'edit'])->name('etudiants.edit')->middleware('role:admin');
Route::post('/etudiants/{id}/modifier', [EtudiantController::class, 'update'])->name('etudiants.update')->middleware('role:admin');
Route::post('/etudiants/{id}/supprimer', [EtudiantController::class, 'destroy'])->name('etudiants.destroy')->middleware('role:admin');
// Route::get('/etudiants/create-with-inscription', [EtudiantController::class, 'createWithInscription'])->name('etudiants.createWithInscription');
// Route::post('/etudiants/store-with-inscription', [EtudiantController::class, 'storeWithInscription'])->name('etudiants.storeWithInscription');
Route::get('etudiants/{id}', [EtudiantController::class, 'show'])->name('etudiants.show')->middleware('role:admin');

// Route::get('/etudiants/archives', [EtudiantController::class, 'archives'])->name('etudiants.archives');




Route::get('/inscriptions/{id}/edit', [EtudiantController::class, 'etudiantsInscritsEdit'])->name('inscriptions.edit')->middleware('role:admin,professeur');
Route::put('/inscriptions/{id}', [EtudiantController::class, 'etudiantsInscritsUpdate'])->name('inscriptions.update')->middleware('role:admin,professeur');
Route::delete('/inscriptions/{id}', [EtudiantController::class, 'etudiantsInscritsDestroy'])->name('inscriptions.destroy')->middleware('role:admin,professeur');

/* les routes de cours  */
Route::prefix('cours')->group(function () {
    Route::get('/', [CoursController::class, 'index'])->name('cours.index')->middleware('role:admin');
    Route::get('/create', [CoursController::class, 'create'])->name('cours.create')->middleware('role:admin');
    Route::post('/', [CoursController::class, 'store'])->name('cours.store')->middleware('role:admin');
    Route::get('/{id}/edit', [CoursController::class, 'edit'])->name('cours.edit')->middleware('role:admin');
    Route::put('/{id}', [CoursController::class, 'update'])->name('cours.update')->middleware('role:admin');
    Route::delete('/{id}', [CoursController::class, 'destroy'])->name('cours.destroy')->middleware('role:admin');
});

/* le sroutes des professeurs */
Route::prefix('professeurs')->name('professeurs.')->group(function () {
    Route::get('/', [ProfesseurController::class, 'index'])->name('index')->middleware('role:admin');
    // Route::get('/create', [ProfesseurController::class, 'create'])->name('create');
    // Route::post('/', [ProfesseurController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [ProfesseurController::class, 'edit'])->name('edit')->middleware('role:admin');
    Route::put('/{id}', [ProfesseurController::class, 'update'])->name('update')->middleware('role:admin');
    Route::delete('/{id}', [ProfesseurController::class, 'destroy'])->name('destroy')->middleware('role:admin');
});

// Registration and Login routes
Route::get('/register/{type?}', [UserController::class, 'showRegisterForm'])->name('register.form')->middleware('role:admin');
Route::post('/register', [UserController::class, 'register'])->name('register')->middleware('role:admin');
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');


Route::prefix('admin/users')->group(function () {
    Route::get('/', [AdminUserController::class, 'index'])->name('admin.users.index')->middleware('role:admin');
    Route::get('/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit')->middleware('role:admin');
    Route::post('/{id}/update', [AdminUserController::class, 'update'])->name('admin.users.update')->middleware('role:admin');
    Route::get('/{id}/reset-password', [AdminUserController::class, 'showResetPasswordForm'])->name('admin.users.resetPasswordForm')->middleware('role:admin');
    Route::post('/{id}/reset-password', [AdminUserController::class, 'resetPassword'])->name('admin.users.resetPassword')->middleware('role:admin');
});