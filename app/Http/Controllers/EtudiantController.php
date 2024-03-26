<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;
use App\Http\Controllers\VilleController;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


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

        $etudiants = Etudiant::select()->paginate(13);
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
        //return $request;

        //return view('etudiant.index', ['data' => $request]); //$tas
        $request->validate(
            [
                'nom' => 'required|string|max:50',
                'adresse' => 'required|max:255',
                'telephone' => 'required|regex:/^\+?[0-9]{1,}$/',
                'email' => 'required|email|max:150|unique:users,email',
                'date_naissance' => 'required|date|date_format:Y-m-d',
                'ville_id' => 'required|exists:villes,id',
                'password' => [
                    'required',
                    'string',
                    Password::min(6)->max(20)->mixedCase()->letters()->numbers()->symbols()
                ],
                'password_confirmation' => 'required|same:password'

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

        //Ajout user
        $user = new User();
        $user->email = $request->email;
        $user->name = $request->nom;
        $user->password = Hash::make($request->password);

        $user->save();
        $userId = $user->id;

        //  Ajout Etudiant
        //mostafa@mostafa.ca / AJuik785@
        $etudiant = Etudiant::create([

            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'date_naissance' => $request->date_naissance,
            'ville_id' => $request->ville_id,
            'id' => $userId
        ]);

        return redirect()->route('login')->with('success', trans('successfully') . ' ' . trans('Added')); // not view('..')

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
        $etudiant['email'] = $etudiant->user->email; // ajout du champ A partir de la relation
        $etudiant['nom'] = $etudiant->user->name; //
        //return $etudiant;
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
                'ville_id' => 'required|exists:villes,id',
                'password' => [
                    'required',
                    'string',
                    Password::min(6)->max(20)->mixedCase()->letters()->numbers()->symbols()
                ],
                'password_confirmation' => 'required|same:password'

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

        //Update user
        $user = User::find($etudiant->id);

        $user->email = $request->email;
        $user->name = $request->nom;
        $user->password = Hash::make($request->password);

        $user->save();
        //$userId = $user->id;


        $etudiant->update([

            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'date_naissance' => $request->date_naissance,
            'ville_id' => $request->ville_id
        ]);

        return redirect()->route('etudiant.index')->with('success', trans('successfully') . ' ' . trans('Modified')); // not view('..')

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etudiant $etudiant)
    {
        //
        $etudiant->delete();
        $user = User::find($etudiant->id);
        $user->delete();

        return redirect()->route('etudiant.index')->with('success', trans('successfully') . ' ' . trans('Deleted'));
    }


    /**
     * hash la dateNaissance d chaque user comme password temp
     */
    public function hashDateNaiss()
    {
        $etudiants = Etudiant::all();
        foreach ($etudiants as $etudiant) {
            $hashDateNaiss = Hash::make($etudiant->date_naissance);
            //$etudiant->user->password = $hashDateNaiss;
            $user = User::find($etudiant->id);
            $user->update([
                'password' => $hashDateNaiss
            ]);
        }
    }


}
