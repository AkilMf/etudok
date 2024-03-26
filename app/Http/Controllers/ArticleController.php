<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $articles = Article::articles();
        //return $articles;
        return view('article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre_en' => 'required|max:200',
            'titre_fr' => 'max:200',
            'contenu_en' => 'required',
            'contenu_fr' => 'max:500',
        ]);
        $titre = [
            'en' => $request->titre_en,
        ];
        $contenu = [
            'en' => $request->contenu_en
        ];

        if ($request->titre_fr != null) {
            $titre = $titre + ['fr' => $request->titre_fr];
        }
        if ($request->contenu_fr != null) {
            $contenu = $contenu + ['fr' => $request->contenu_fr];
        }

        $currentDate = Carbon::now()->format('Y-m-d');
        //return $currentDate;
        $newArticle = [
            'titre' => $titre,
            'contenu' => $contenu,
            'etudiant_id' => Auth::user()->id,
            'date' => $currentDate

        ];

        Article::create($newArticle);

        return redirect()->route('article.index')->withSuccess('Article ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {

        $articles = Article::articles();
        $articleF = '';
        foreach ($articles as $articleB)
            if ($articleB['id'] == $article->id) {
                $articleF = $articleB;
                break;
            }


        return view('article.show', compact('articleF'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
        //return array_key_exists('fr', $article->titre);

        abort_unless($article->etudiant_id === Auth::user()->id, 401); // si vous n etes pas le proprio de l'article 
        return view('article.edit', ["article" => $article]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        abort_unless($article->etudiant_id === Auth::user()->id, 401);

        $request->validate([
            'titre_en' => 'required|max:200',
            'titre_fr' => 'max:200',
            'contenu_en' => 'required',
            'contenu_fr' => 'max:500',
        ]);
        $titre = [
            'en' => $request->titre_en,
        ];
        $contenu = [
            'en' => $request->contenu_en
        ];

        if ($request->titre_fr != null) {
            $titre = $titre + ['fr' => $request->titre_fr];
        }
        if ($request->contenu_fr != null) {
            $contenu = $contenu + ['fr' => $request->contenu_fr];
        }

        $currentDate = Carbon::now()->format('Y-m-d');
        //return $currentDate;

        $article->update([
            'titre' => $titre,
            'contenu' => $contenu,
            'date' => $currentDate

        ]);

        return redirect()->route('article.index')->withSuccess('Article Modifiée avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {

        abort_unless($article->etudiant_id === Auth::user()->id, 401);

        $article->delete();
        return redirect()->route('article.index')->with('success', 'Article deleted successfully!');
    }
}
