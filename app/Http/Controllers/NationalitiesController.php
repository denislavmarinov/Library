<?php

namespace App\Http\Controllers;

use App\Author;
use App\Nationality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NationalitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nationalities = Nationality::all();

        return view('nationalities.index', compact('nationalities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nationalities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $flag_extension = $request->file('flag')->getClientOriginalExtension();

        $flag_name = str_replace(' ', '_', $request->nationality);

        $flag_path = $request->file('flag')->storeAs('public/flags', $flag_name .'.' . $flag_extension);


        $nationality = ['nationality' => $request->nationality,
                                'history_link' => $request->history_link,
                                'flag' => 'flags/'. $flag_name .'.' . $flag_extension
                                ];
        DB::table('nationalities')->insert($nationality);

        return redirect()->route('nationalities.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Nationality  $nationality
     * @return \Illuminate\Http\Response
     */
    public function show(Nationality $nationality)
    {
        $nationality = Nationality::get_nationality_with_history_link_and_flag($nationality->id);

        $authors_books = [];
        foreach ($nationality as $author)
        {
            $book_count = Author::select_author_with_count_of_books($author->author_id);
            array_push($authors_books, [
                'author' => $author->author_id,
                'count_of_books' => $book_count[0]->book_count
            ]);
        }

        return view('nationalities.show', compact('nationality', 'authors_books'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nationality  $nationality
     * @return \Illuminate\Http\Response
     */
    public function edit(Nationality $nationality)
    {
         $nationality = Nationality::find($nationality)->first();

        return view('nationalities.edit', compact('nationality'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nationality  $nationality
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nationality $nationality)
    {
        $flag_extension = $request->file('flag')->getClientOriginalExtension();

        $flag_name = str_replace(' ', '_', $request->nationality);

        $flag_path = $request->file('flag')->storeAs('public/flags', $flag_name .'.' . $flag_extension);


        $updated_nationality = ['nationality' => $request->nationality,
                                'history_link' => $request->history_link,
                                'flag' => 'flags/'. $flag_name .'.' . $flag_extension
                                ];
        DB::table('nationalities')->where('id', '=', $nationality->id)->update($updated_nationality);

        return redirect()->route('nationalities.show', $nationality->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nationality  $nationality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nationality $nationality)
    {
        //
    }
}
