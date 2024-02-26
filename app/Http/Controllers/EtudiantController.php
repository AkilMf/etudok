<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;
use App\Http\Controllers\VilleController;


class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // calling index function from VilleController
        $villeController = app(VilleController::class);
        $villes = $villeController->index();

        $etudiants = Etudiant::all();
        return view('etudiant.index', ['etudiants' => $etudiants, 'villes' => $villes]); //$tasks[0]->title
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $villeController = app(VilleController::class);
        $villes = $villeController->index();

        return view('etudiant.create', ['villes' => $villes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //return view('etudiant.index', ['data' => $request]); //$tas
        $request->validate(
            [
                'nom' => 'required|string|max:50',
                'adresse' => 'required|max:255',
                'telephone' => 'required|regex:/^\+?[0-9]{1,}$/',
                'email' => 'required|email|max:150',
                'date_naissance' => 'required|date|date_format:Y-m-d',
                'ville_id' => 'required|exists:villes,id'

            ],
            [   //Personalise les messages d'erreur
                'nom.required' => 'Le nom est requis !',
                'adresse.required' => "L'adresse est requise !",
                'telephone.required' => 'Le telephone est requis !',
                'email.required' => 'Votre courrriel est requis!',
                'date_naissance.required' => 'Votre date de naissance est requise!',
                'date_naissance.date_format' => 'Format de date de naissance invalide!',
                'ville_id.required' => 'La ville est requise !',
                'ville_id.exists' => "Non! Cette ville n'existe pas!",
            ]
        );

        // Si validee

        $etudiant = Etudiant::create([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'date_naissance' => $request->date_naissance,
            'ville_id' => $request->ville_id
        ]);

        return redirect()->route('etudiant.index')->with('success', "l'étudiant a été ajouté avec succès :)"); // not view('..')

    }

    /**
     * Display the specified resource.
     */
    public function show(Etudiant $etudiant)
    {
        //
        $villeController = app(VilleController::class);
        $villes = $villeController->index();
        return view('etudiant.show', ["etudiant" => $etudiant, "villes" => $villes]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Etudiant $etudiant)
    {
        //
        $villeController = app(VilleController::class);
        $villes = $villeController->index();
        return view('etudiant.edit', ["etudiant" => $etudiant, "villes" => $villes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        //
        $request->validate(
            [
                'nom' => 'required|string|max:50',
                'adresse' => 'required|max:255',
                'telephone' => 'required',
                'email' => 'required|email|max:150',
                'date_naissance' => 'required|date|date_format:Y-m-d',
                'ville_id' => 'required|exists:villes,id'

            ],
            [   //Personalise les messages d'erreur
                'nom.required' => 'Le nom est requis !',
                'adresse.required' => "L'adresse est requise !",
                'telephone.required' => 'Le telephone est requis !',
                'email.required' => 'Votre courrriel est requis!',
                'date_naissance.required' => 'Votre date de naissance est requise!',
                'date_naissance.date_format' => 'Format de date de naissance invalide!',
                'ville_id.required' => 'La ville est requise !',
                'ville_id.exists' => "Non! Cette ville n'existe pas!",
            ]
        );

        // Si validee

        $etudiant->update([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'date_naissance' => $request->date_naissance,
            'ville_id' => $request->ville_id
        ]);

        return redirect()->route('etudiant.index')->with('success', "Des Informations de " . $request->nom . " ont été Modifiés avec succès :)"); // not view('..')

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etudiant $etudiant)
    {
        //
        $etudiant->delete();

        return redirect()->route('etudiant.index')->with('success', "l'Etudiant a été supprimé avec succès !");
    }
}
