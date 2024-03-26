<?php

namespace App\Http\Controllers;

use App\Models\Fichier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class FichierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fichiers = Fichier::fichiers();
        //return $articles;
        $fichiers = $this->paginate($fichiers);
        return view('fichier.index', compact('fichiers'));
    }

    /**
     * paginate an array    Source : https://laracoding.com/how-to-paginate-an-array-in-laravel/
     */
    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('fichier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //
        $request->validate([
            'titre_en' => 'required|max:255',
            'file' => 'required|max:10000|mimes:pdf,zip,doc' //10 mega

        ]);
        // upload file to local public folder
        $fileName = '';
        if ($request->has('file')) {
            $fichier = $request->file;
            $extension = strtolower($fichier->extension());
            $fileName = time() . rand(1, 99999) . '.' . $extension; // generate new name
            $fichier->getClientOriginalName = $fileName;
            $fichier->move('fichiers', $fileName);
        }
        // adding titre ..
        $titre = [
            'en' => $request->titre_en,
        ];

        if ($request->titre_fr != null) {
            $titre = $titre + ['fr' => $request->titre_fr];
        }

        $currentDate = Carbon::now()->format('Y-m-d');
        //return $currentDate;
        $newFile = [
            'titre' => $titre,
            'etudiant_id' => Auth::user()->id,
            'date' => $currentDate,
            'file' => $fileName

        ];

        Fichier::create($newFile);

        return redirect()->route('fichier.index')->withSuccess(trans('successfully') . ' ' . trans('Added'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Fichier $fichier)
    {
        //

        $fichiers = Fichier::fichiers();
        $fichierF = '';
        foreach ($fichiers as $file)
            if ($file['id'] == $fichier->id) {
                $fichierF = $file;
                break;
            }
        $extension = pathinfo($fichierF['file'], PATHINFO_EXTENSION);
        $fichierF['extension'] = $extension;
        return view('fichier.show', compact('fichierF'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fichier $fichier)
    {

        abort_unless($fichier->etudiant_id === Auth::user()->id, 401); // si vous n etes pas le proprio de l'article 
        return view('fichier.edit', ["fichier" => $fichier]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fichier $fichier)
    {
        //return $fichier;


        abort_unless($fichier->etudiant_id === Auth::user()->id, 401);

        $request->validate([
            'titre_en' => 'required|max:200',
            'titre_fr' => 'max:200',
        ]);
        $titre = [
            'en' => $request->titre_en,
        ];

        if ($request->titre_fr != null) {
            $titre = $titre + ['fr' => $request->titre_fr];
        }

        $currentDate = Carbon::now()->format('Y-m-d');

        //delete from dossier
        File::delete('fichiers/' . $fichier['file']);

        $fileName = '';
        if ($request->has('file')) {
            $newFichier = $request->file;

            $extension = strtolower($newFichier->extension());
            $fileName = time() . rand(1, 99999) . '.' . $extension; // generate new name
            $newFichier->getClientOriginalName = $fileName;
            $newFichier->move('fichiers', $fileName);
        }


        $fichier->update([
            'titre' => $titre,
            'date' => $currentDate,
            'file' => $fileName

        ]);

        return redirect()->route('fichier.index')->withSuccess(trans('successfully') . ' ' . trans('Modified'));
        //return redirect()->route('fichier.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fichier $fichier)
    {
        //

        abort_unless($fichier->etudiant_id === Auth::user()->id, 401);

        //from DB
        $fichier->delete();

        //from Storage /fichiers
        File::delete('fichiers/' . $fichier['file']);

        return redirect()->route('fichier.index')->with('success', trans('successfully') . ' ' . trans('Deleted'));

    }
}
