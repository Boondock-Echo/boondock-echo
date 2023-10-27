<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News; // Make sure to import the News model
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
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
    public function updatedata(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $article = News::findOrFail($id);

        $article->update($validatedData);
        $article->save();
        return redirect()->route('news-admin.edit', $article->id)->with('success', 'News article updated successfully');
    }
    public function updateImages(Request $request, $id)
    {
        $article = News::findOrFail($id);
    
        // Handle hero image update, if any
        if ($request->hasFile('hero_image')) {
            $this->validate($request, [
                'hero_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
            ]);
    
            $heroImage = $request->file('hero_image');
            $heroImageName = time() . '.' . $heroImage->getClientOriginalExtension();
            $heroImage->storeAs('public/news_images', $heroImageName);
    
            // Delete the old hero image file if it exists
            if ($article->hero_image) {
                $oldHeroImage = storage_path('app/public/news_images/' . $article->hero_image);
                if (File::exists($oldHeroImage)) {
                    File::delete($oldHeroImage);
                }
            }
    
            $article->hero_image = $heroImageName;
        }
    
        // Handle card image update, if any
        if ($request->hasFile('card_image')) {
            $this->validate($request, [
                'card_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
            ]);
    
            $cardImage = $request->file('card_image');
            $cardImageName = time() . '_card.' . $cardImage->getClientOriginalExtension();
            $cardImage->storeAs('public/news_images', $cardImageName);
    
            // Delete the old card image file if it exists
            if ($article->card_image) {
                $oldCardImage = storage_path('app/public/news_images/' . $article->card_image);
                if (File::exists($oldCardImage)) {
                    File::delete($oldCardImage);
                }
            }
    
            $article->card_image = $cardImageName;
        }
    
        $article->save();
    
        return redirect()->route('news-admin.edit', $article->id)->with('success', 'Images updated successfully');
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