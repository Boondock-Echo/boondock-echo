<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News; // Make sure to import the News model
use Illuminate\Support\Facades\Storage;

class NewsAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = News::paginate(10);
        return view('news-admin.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news-admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'body' => 'required|string',
            // 'published' => 'required',
            'hero_image' => 'required|image',
            'card_image' => 'required|image',
        ]);

        $validatedData['author_id'] = auth()->user()->id;

       // Handle file uploads for hero_image and card_image
$heroImagePath = $request->file('hero_image')->store('public/news_images');
$cardImagePath = $request->file('card_image')->store('public/news_images');

// Transform the stored paths to URLs
$heroImageUrl = str_replace('public/', '', $heroImagePath);
$cardImageUrl = str_replace('public/', '', $cardImagePath);

$article = News::create(array_merge($validatedData, [
    'hero_image' => $heroImageUrl,
    'card_image' => $cardImageUrl,
]));

        return redirect()->route('news-admin.index')->with('success', 'News article created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = News::findOrFail($id);
        return view('news-admin.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = News::findOrFail($id);
        
        
        return view('news-admin.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'body' => 'required|string',
        ]);

        $article = News::findOrFail($id);

        $article->update($validatedData);

        return redirect()->route('news-admin.show', $article->id)->with('success', 'News article updated successfully');
    }
    public function updateImage(Request $request, News $article, $imageType)
    {
        $this->validate($request, [
            $imageType . '_image' => 'required|image',
        ]);
    
        $imagePath = $request->file($imageType . '_image')->store('public/news_images');
        $imageUrl = str_replace('public/', '', $imagePath);
    
        if ($imageType === 'card') {
            $article->card_image = $imageUrl;
        } elseif ($imageType === 'hero') {
            $article->hero_image = $imageUrl;
        }
    
        $article->save();
    
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = News::findOrFail($id);
        $article->delete();

        return redirect()->route('news-admin.index')->with('success', 'News article deleted successfully');
    }

    public function postpublish(Request $request)
    {
        $postId = $request->input('postId');
        $published = $request->input('published');

        // Update the user's live_mode value in the database
        $news = News::findOrFail($postId);
        $news->published = $published;
        $news->save();

        // Return a JSON response indicating success
        return response()->json(['success' => true]);
    }
    public function postpinned(Request $request)
    {
        $postId = $request->input('postId');
        $pinned = $request->input('pinned');

        // Update the user's live_mode value in the database
        $news = News::findOrFail($postId);
        $news->pinned = $pinned;
        $news->save();

        // Return a JSON response indicating success
        return response()->json(['success' => true]);
    }

    

    
}
