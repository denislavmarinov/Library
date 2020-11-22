<?php

namespace App\Http\Controllers;

use App\Book;
use App\Author;
use Carbon\Carbon;
use App\Nationality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AuthorsRequest;
use Illuminate\Support\Facades\Storage;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::get_all_authors();

        foreach ($authors as $author)
        {
            $author->date_of_birth = Carbon::parse($author->date_of_birth)->format('d m Y');
        }

        return view('authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $nationalities = Nationality::get_all_nationalities();
        $nationalities = $nationalities->pluck('nationality', 'id');

        return view('authors.create', compact('nationalities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AuthorsRequest $request)
    {
        $extension = $request->file('image')->getClientOriginalExtension();

        $filename = str_replace(' ', '', $request->first_name) . '_' . str_replace(' ', '', $request->last_name) . '-' . rand();


        $image = $request->file('image')->storeAs('public/authors', $filename .'.' . $extension);

        $author = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'date_of_death' => $request->date_of_death,
            'nationality' => $request->nationality,
            'biographic' => $request->biographic,
            'image' => 'authors/' . $filename .'.' . $extension,
            'created_at' => now(),
            'updated_at' => now()
        ];

        Author::insert_author($author);
        return redirect()->route('authors.index')->with(['message' => 'Successfully added author!', 'type' =>'success'])->with([
            'message' => 'Successfully added author!',
            'type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        $author = Author::select_author($author->id)[0];

        $author->date_of_birth = Carbon::parse($author->date_of_birth)->format('d m Y');
        if ($author->date_of_death != null)
        {
            $author->date_of_death = Carbon::parse($author->date_of_death)->format('d m Y');
        }
        else
        {
            $author->date_of_death = "Alive";
        }

        $books = Author::select_author_with_count_of_books($author->id)[0]->book_count;

        $all_books = Author::select_authors_books($author->id);

        return view('authors.show', compact('author', 'books', 'all_books'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {

        $author = Author::select_author($author->id);

        $nationalities = Nationality::get_all_nationalities();
        $nationalities = $nationalities->pluck('nationality', 'id');

        return view('authors.edit', compact('author', 'nationalities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(AuthorsRequest $request, Author $author)
    {
        Storage::delete( 'public/' . $author->image );

        $extension = $request->file('image')->getClientOriginalExtension();

        $filename = str_replace(' ', '', $request->first_name) . '_' . str_replace(' ', '', $request->last_name) . '-' . rand();

        $image = $request->file('image')->storeAs('public/authors', $filename .'.' . $extension);

        $new_author = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'date_of_death' => $request->date_of_death,
            'nationality' => $request->nationality,
            'biographic' => $request->biographic,
            'image' => 'authors/' . $filename .'.' . $extension,
            'updated_at' => now()
        ];

        Author::update_author($new_author, $author->id);
        return redirect()->route('authors.index')->with(['message' => 'Successfully added author!', 'type' =>'success'])->with([
            'message' => 'Successfully edited author!',
            'type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        Storage::delete( 'public/' . $author->image );

        Author::delete_author($author->id);

        return redirect()->route('authors.index')->with([
            'message' => 'Successfully deleted author!',
            'type' => 'success'
        ]);
    }
}
