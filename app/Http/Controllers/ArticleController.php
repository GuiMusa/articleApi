<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $article = Article::all();
         return response()->json([
            'success' => true,
            'article' => $article 
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validation des donnée
        $validateData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'published' => 'boolean'
        ]);

        //creation dun article en base 
        $article = Article::create($validateData);

        //confirmation de l'article au format JSON
        return response()->json([
            'success'=> true,
            'message'=>'Article créé avec succès',
            'article'=>$article
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
        return response()->json([
            'success' => true,
            'article' => $article 
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
         $validateData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'published' => 'boolean'
        ]);

        //update dun article en base 
        $article->update($validateData);

        //confirmation de l'article au format JSON
        return response()->json([
            'success'=> true,
            'message'=>'Article modifier avec succès',
            'article'=>$article
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
         $article->delete();

        //confirmation de l'article au format JSON
        return response()->json([
            'success'=> true,
            'message'=>'Article supprimer',
            
        ]);
    }
}
