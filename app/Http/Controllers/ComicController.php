<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comic;

class ComicController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $comics = Comic::all();
        return view('comics.index', compact('comics'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('comics.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'required|in:Action,Comedy,Drama,Fantasy,Horror,Mystery,Romance',
            'rate' => 'required|numeric|min:1|max:5',
            'chapter' => 'required|numeric|min:1|max:2000',
            'is_complete' => 'required|in:true,false'
        ]);
        
        $comics = $this->comics();
        $id =max(array_keys($comics)) + 1;

        $comics[$id] = [
            'id' => $id,
            'title' => $validated['title'],
            'author' => $validated['author'],
            'genre' => $validated['genre'],
            'rate' => $validated['rate'],
            'chapter' => $validated['chapter'],
            'is_complete' => $validated['is_complete']
        ];

        $this->saveComics($comics);

        return redirect()->route('comics.index')->with('success', 'Comic added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $comic = Comic::findOrFail($id);
        return view('comics.show', compact('comic'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function filter($value)
    {
        return redirect()->route('comics.index', [
            'genre' => $value
        ]);
    }

    private function comics()
    {
        $path = storage_path('app/comics.json');

        return json_decode(file_get_contents($path), true);
    }

    private function saveComics($comics)
    {
        file_put_contents(
            storage_path('app/comics.json'),
            json_encode($comics, JSON_PRETTY_PRINT)
        );
    }

}
