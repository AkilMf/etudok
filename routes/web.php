<?php

use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\FichierController;
use App\Http\Controllers\VilleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SetLocaleController;
use App\Http\Controllers\ArticleController;


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

Route::get('/', function () {
    return view('welcome');
})->name('etudiant.welcome');




//Ajout new etudiant
Route::get('/create/etudiant', [EtudiantController::class, 'create'])->name('etudiant.create');
Route::post('/create/etudiant', [EtudiantController::class, 'store'])->name('etudiant.store');



//applique un middleware d'authentification à plusieurs routes au sein d'un groupe.
Route::middleware('auth')->group(function () {
    //displaying 1 etudiant
    Route::get('/etudiant/{etudiant}', [EtudiantController::class, 'show'])->name('etudiant.show');

    // Update etudiant
    //edit
    Route::get('/edit/etudiant/{etudiant}', [EtudiantController::class, 'edit'])->name('etudiant.edit');

    //update
    Route::put('/edit/etudiant/{etudiant}', [EtudiantController::class, 'update'])->name('etudiant.update');

    //Delete
    Route::delete('/etudiant/{etudiant}', [EtudiantController::class, 'destroy'])->name('etudiant.delete');


    //display all etudiants
    Route::get('/etudiants', [EtudiantController::class, 'index'])->name('etudiant.index');


    //Articles
    Route::get('/create/article', [ArticleController::class, 'create'])->name('article.create');
    Route::post('/create/article', [ArticleController::class, 'store'])->name('article.store');
    Route::get('/forum', [ArticleController::class, 'index'])->name('article.index');

    Route::get('/article/{article}', [ArticleController::class, 'show'])->name('article.show');

    Route::delete('/article/{article}', [ArticleController::class, 'destroy'])->name('article.delete');

    Route::get('/edit/article/{article}', [ArticleController::class, 'edit'])->name('article.edit');
    Route::put('/edit/article/{article}', [ArticleController::class, 'update'])->name('article.update');

    //fichiers
    Route::get('/create/fichier', [FichierController::class, 'create'])->name('fichier.create');
    Route::post('/create/fichier', [FichierController::class, 'store'])->name('fichier.store');

    Route::get('/documents', [FichierController::class, 'index'])->name('fichier.index');
    Route::get('/fichier/{fichier}', [FichierController::class, 'show'])->name('fichier.show');
    Route::delete('/fichier/{fichier}', [FichierController::class, 'destroy'])->name('fichier.delete');

    Route::get('/edit/fichier/{fichier}', [FichierController::class, 'edit'])->name('fichier.edit');
    Route::put('/edit/fichier/{fichier}', [FichierController::class, 'update'])->name('fichier.update');

});



// Auth
Route::get('/login', [AuthController::class, 'create'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('login.store');
Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');

//lang
Route::get('/lang/{locale}', [SetLocaleController::class, 'index'])->name('lang');











