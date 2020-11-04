<?php

namespace App\Http\Controllers;

use App\Book;
use App\Genre;
use App\Author;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	if ((isset($request->sort_by) && isset($request->sort_order)) ||  isset($request->filter)  && (!empty($request->sort_by)  && !empty($request->sort_order)) || !empty($request->filter))
    	{
    		if (isset($request->sort_by) && !isset($request->filter))
    		{
    			$books  = Book::get_all_books_with_authors_genres_and_sort($request->sort_by, $request->sort_order);
    		}
    		elseif (!isset($request->sort_by) && isset($request->filter))
    		{
    			$books  = Book::get_all_books_with_authors_genres_and_filter($request->filter);
    		}
    		else
    		{
    			$books  = Book::get_all_books_with_authors_genres_filter_and_sort($request->filter, $request->sort_by, $request->sort_order);
    		}
    	}
    	else
    	{
        	$books = Book::get_all_books_with_authors_and_genres();
    	}

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	// If the admin is uploading the book get all authors, otherwise the logged users name and id should be sent
        $authors = Author::get_all_authors();
        for ($i = 0; $i < count($authors); $i++)
        {
        	$authors_temp[$authors[$i]->id] = $authors[$i]->author_name;
        }
        $authors = $authors_temp;
        // $authors = $authors->pluck('author_name', 'id');
        $genres = Genre::get_all_genres();
        $genres = $genres->pluck('genre', 'id');
        return view('books.create', compact('authors', 'genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $books = Book::get_all_books_with_authors_and_genres();

        $book = $books[0];

        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
