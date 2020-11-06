<?php

namespace App\Http\Controllers;

use App\Book;
use App\Genre;
use App\Author;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::user()->role_id == '3')
        {
            $authors = [Auth::id() => Auth::user()->first_name . ' ' . Auth::user()->last_name];
        }
        else
        {
            $authors = Author::get_all_authors();

            for ($i = 0; $i < count($authors); $i++)
            {
            	$authors_temp[$authors[$i]->id] = $authors[$i]->author_name;
            }
            $authors = $authors_temp;
        }

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
    public function store(BookRequest $request)
    {
        $book = [
            'title' => $request->title,
            'isbn' => $request->isbn,
            'pages' => $request->pages,
            'short_content' => $request->short_content,
            'author' => $request->author,
            'edition' => $request->edition,
            'genre' => $request->genre,
            'file_path' => ' ',
            'added_by' => Auth::user()->id
        ];

        dd($book);

        $result = Book::add_new_book($book);

        if ($result)
        {
            return redirect()->route('books.index')->with('message', 'Book successfully added!');
        }
        else
        {
            return redirect()->route('books.index')->with('message', 'Something went wrong try again later!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $books = Book::get_book_to_show($book->id);

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
        $book = Book::select_book_to_update($book->id);

        $authors = Author::select_author($book->first()->author);
        $authors = [
            $authors[0]->id => $authors[0]->author_name
        ];

        $genres = Genre::get_all_genres();
        $genres = $genres->pluck('genre', 'id');

        return view('books.edit', compact('book', 'authors', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, Book $book)
    {
        $new_book = [
            'title' => $request->title,
            'isbn' => $request->isbn,
            'pages' => $request->pages,
            'short_content' => $request->short_content,
            'author' => $request->author,
            'edition' => $request->edition,
            'genre' => $request->genre
        ];

        $result = Book::update_book($book->id, $new_book);

        if ($result)
        {
            return redirect()->route('books.show', $book->id)->with('message', 'Book was successfully updated');
        }
        else
        {
            return redirect()->route('books.show', $book->id)->with('message', 'Something went wrong! Try again later!');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $result = Book::delete_book($book->id);

        if ($result)
        {
            return redirect()->route('books.index')->with('message', 'Book was successfully deleted!');
        }
        else
        {
            return redirect()->route('books.index')->with('message', 'Something went wrong! Try again later!');
        }
    }
}
