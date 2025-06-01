<?php

namespace App\Http\Controllers;

use App\Models\Article;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class ArticleController extends Controller implements HasMiddleware
{
   public static function middleware(){
        return [
            new Middleware( 'permission:view articles',only: ['index'] ),
            new Middleware( 'permission:edit articles',only: ['edit'] ),
            new Middleware( 'permission:create articles',only: ['create', 'store'] ),
            new Middleware( 'permission:delete articles',only: ['destroy'] ),
            new Middleware( 'permission:show articles',only: ['show'] ),
            new Middleware( 'permission:update articles',only: ['update'] ),
        ];
    } 
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch articles with pagination
        $articles = Article::paginate(10);

        // Return the view with articles
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the view for creating a new article
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'author' => 'nullable|string|max:255',
        ]);

        // Create a new article
        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'author' => $request->author,
        ]);

        // Redirect to the articles index with a success message
        return redirect()->route('articles.index')->with('success', 'Article created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        // Return the view for showing a specific article
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        // Return the view for editing a specific article
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'author' => 'nullable|string|max:255',
        ]);

        // Update the article
        $article->update([
            'title' => $request->title,
            'content' => $request->content,
            'author' => $request->author,
        ]);

        // Redirect to the articles index with a success message
        return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        // Delete the article
        $article->delete();

        // Redirect to the articles index with a success message
        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }
}
