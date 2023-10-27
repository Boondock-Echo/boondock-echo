<?php

// app/Http/Controllers/NewsroomController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Author;
use App\Models\Tag;

class NewsroomController extends Controller
{
    public function index()
    {
        $articles = News::where('published' ,'1')->orderBy('pinned', 'desc')->latest()->paginate(6);
    
        return view('newsroom.index', compact('articles'));
    }
    
    public function show($id)
    {
        $article = News::findOrFail($id);
    
        // Fetch recent posts (excluding the current article)
        $recentPosts = News::where('id', '!=', $id)
            ->latest()
            ->take(4) // You can adjust the number of recent posts to display
            ->get();
    
        return view('newsroom.news_detail', compact('article', 'recentPosts'));
    }
    

    public function create()
    {
        $authors = Author::all();
        $tags = Tag::all();
        return view('newsroom.create', compact('authors', 'tags'));
    }

    public function store(Request $request)
    {
        // Validation for request inputs here
        
        $article = new News();
        $article->title = $request->input('title');
        $article->description = $request->input('description');
        $article->body = $request->input('body');
        $article->hero_image = $request->file('hero_image')->store('images');
        $article->card_image = $request->file('card_image')->store('images');
        $article->author_id = $request->input('author_id');
        $article->save();
        
        $article->tags()->attach($request->input('tags'));

        return redirect()->route('news.index')->with('success', 'Article created successfully!');
    }

    public function edit($id)
    {
        $article = News::findOrFail($id);
        $authors = Author::all();
        $tags = Tag::all();
        return view('newsroom.edit', compact('article', 'authors', 'tags'));
    }

    public function update(Request $request, $id)
    {
        // Validation for request inputs here

        $article = News::findOrFail($id);
        $article->title = $request->input('title');
        $article->description = $request->input('description');
        $article->body = $request->input('body');

        if ($request->hasFile('hero_image')) {
            $article->hero_image = $request->file('hero_image')->store('images');
        }

        if ($request->hasFile('card_image')) {
            $article->card_image = $request->file('card_image')->store('images');
        }

        $article->author_id = $request->input('author_id');
        $article->save();

        $article->tags()->sync($request->input('tags'));

        return redirect()->route('news.index')->with('success', 'Article updated successfully!');
    }

    public function destroy($id)
    {
        $article = News::findOrFail($id);
        $article->tags()->detach();
        $article->delete();

        return redirect()->route('news.index')->with('success', 'Article deleted successfully!');
    }
}
