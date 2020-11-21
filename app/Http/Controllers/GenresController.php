<?php

namespace App\Http\Controllers;

use App\Genre;
use Illuminate\Http\Request;
use App\Http\Requests\GenresRequest;
use Illuminate\Support\Facades\DB;

class GenresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = Genre::all();

        return view('genres.index', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('genres.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GenresRequest $request)
    {
        $genre = [
            'genre' => $request->genre,
            'description' => $request->description,
            'created_at' => now(),
            'updated_at' => now()
        ];
        DB::table('genres')->insert($genre);

        return redirect()->route('genres.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre)
    {
        $genre = Genre::get_genre_with_authors_end_books($genre->id);

        return view('genres.show', compact('genre'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function edit(Genre $genre)
    {
        $genre = Genre::find($genre->id)->first();

        return view('genres.edit', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(GenresRequest $request, Genre $genre)
    {
        $updated_genre = [
            'genre' => $request->genre,
            'description' => $request->description,
            'updated_at' => now()
        ];
        DB::table('genres')->where('id', '=', $genre->id)->update($updated_genre);

        return redirect()->route('genres.show', $genre->id);
    }


}
