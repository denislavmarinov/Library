<?php

namespace App\Http\Controllers;

use App\Book;
use App\Genre;
use App\Author;
use App\Wishlist;
use Carbon\Carbon;
use Pelago\Emogrifier;
use Spatie\PdfToText\Pdf;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        $extension = $request->file('book_file')->getClientOriginalExtension();

        $filename = str_replace(' ', '_', $request->title) . '-' . rand();

        $file_path = $request->file('book_file')->storeAs('public/books', $filename .'.' . $extension);

        $book = [
            'title' => $request->title,
            'isbn' => $request->isbn,
            'pages' => $request->pages,
            'short_content' => $request->short_content,
            'author' => $request->author,
            'edition' => $request->edition,
            'genre' => $request->genre,
            'file_path' => 'books/' . $filename .'.' . $extension,
            'added_by' => Auth::user()->id,
            'created_at' => now(),
            'updated_at' => now()
        ];

        $result = Book::add_new_book($book);

        if ($result)
        {
            return redirect()->route('books.index')->with(['message'=> 'Book successfully added!', 'type' =>'success']);
        }
        else
        {
            return redirect()->route('books.index')->with(['message' => 'Something went wrong try again later!!', 'type' =>'danger']);
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
        $extension = $request->file('book_file')->getClientOriginalExtension();

        $filename = str_replace(' ', '_', $request->title) . '-' . rand();

        $file_path = $request->file('book_file')->storeAs('public/books', $filename .'.' . $extension);

        Storage::delete('public/' . $book->file_path);

        $updated_book = [
            'title' => $request->title,
            'isbn' => $request->isbn,
            'pages' => $request->pages,
            'short_content' => $request->short_content,
            'file_path' => 'books/' . $filename .'.' . $extension,
            'author' => $request->author,
            'edition' => $request->edition,
            'genre' => $request->genre,
            'updated_at' => now()
        ];

        $result = Book::update_book($book->id, $updated_book);

        if ($result)
        {
            return redirect()->route('books.show', $book->id)->with(['message' => 'Book was successfully updated', 'type' =>'success']);
        }
        else
        {
            return redirect()->route('books.show', $book->id)->with(['message' => 'Something went wrong! Try again later!', 'type' =>'danger']);
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
        Storage::delete('public/' . $book->file_path);
        $result = Book::delete_book($book->id);

        if ($result)
        {
            return redirect()->route('books.index')->with(['message' => 'Book was successfully deleted!', 'type' =>'success']);
        }
        else
        {
            return redirect()->route('books.index')->with(['message' => 'Something went wrong! Try again later!', 'type' =>'danger']);
        }
    }

    public function start_reading (Book $book)
    {
        $result = Wishlist::book_exist_in_wishlist($book->id, Auth::id());
        if($result)
        {
            Wishlist::delete_book_from_wishlist($result[0]->id);
        }

        $book_user = [
            'book' => $book->id,
            'user' => Auth::id(),
            'up_to_page' => '0',
            'started_to_read' => now(),
            'ended_to_read' => null,
            'read' => '0',
            'created_at' => now(),
            'updated_at' => now()
        ];

        $result = Book::check_if_book_is_already_in_readlist($book->id, Auth::id());

        if($result)
        {
            return redirect()->back()->with(['message' => 'Book is already in your readlist!', 'type' =>'warning']);
        }

        $result = Book::add_book_to_readlist($book_user);

        if ($result)
        {
            return redirect()->route('read_book', $book->id)->with(['message' => 'Successfully added book to readlist!', 'type' =>'success']);
        }
        else
        {
            return redirect()->route('books.show', $book->id)->with(['message' => 'Something went wrong! Please try again later!', 'type' =>'danger']);
        }

    }
    public function read_book (Book $book)
    {
        $user_page = Book::get_user_up_to_page(Auth::id(), $book->id);

        $full_settings = [
            'pdftohtml_path' => 'C:\poppler-0.68.0\bin\pdftohtml.exe', // path to pdftohtml
            'pdfinfo_path' => 'C:\poppler-0.68.0\bin\pdfinfo.exe', // path to pdfinfo
            'generate' => [ // settings for generating html
                'singlePage' => false, // we want separate pages
                'imageJpeg' => false, // we want png image
                'ignoreImages' => false, // we need images
                'zoom' => 1.75, // scale pdf
                'noFrames' => false, // we want separate pages
            ],
            'clearAfter' => true, // auto clear output dir (if removeOutputDir==false then output dir will remain)
            'removeOutputDir' => true, // remove output dir
            'outputDir' => '/tmp/'.uniqid(), // output dir
            'html' => [ // settings for processing html
                'inlineCss' => true, // replaces css classes to inline css rules
                'inlineImages' => true, // looks for images in html and replaces the src attribute to base64 hash
                'onlyContent' => true, // takes from html body content only
            ]
        ];
        $pdf = new \TonchikTm\PdfToHtml\Pdf(storage_path('app/public/' . $book->file_path), $full_settings);

        // Get counted pages
        $count_of_pages = $pdf->countPages();

        // Get all pages content
        $all_pages_content = $pdf->getHtml()->getAllPages();

        return view('books.read_book', compact('user_page', 'count_of_pages', 'all_pages_content', 'book'));
    }

    public function save_up_to_page (Request $request, Book $book)
    {
        // Get read pages from the book
        $up_to_page_before_today = Book::get_user_up_to_page(Auth::id(), $book->id)[0]->up_to_page;
        // Find the pages read today
        $read_today = (int) $request->up_to_page - (int)$up_to_page_before_today;
        // Get the pages read up to now in the book
        $read_pages_for_today_without_the_new_ones = Book::get_pages_since_now_for_today(Auth::id(), Carbon::now()->weekOfYear, lcfirst(Carbon::now()->isoFormat('dddd')), Carbon::now()->year);
        // If the user had not read book this week
        if (empty($read_pages_for_today_without_the_new_ones[0])) {
            // Make the row in db
            Book::create_new_row_at_user_speed_table(Auth::id(), Carbon::now()->weekOfYear, Carbon::now()->year);
            // Make array same as if the user had read some pages already
            $read_pages_for_today_without_the_new_ones = [
                lcfirst(Carbon::now()->isoFormat('dddd')) => 0,
                'week_num' => Carbon::now()->weekOfYear,
                'year' => Carbon::now()->year
            ];
        }
        // The day of week, which is today
        $today_type_day = lcfirst(Carbon::now()->isoFormat('dddd'));
        // The pages read for today in all books
        $pages_to_add_in_db = (int) $read_pages_for_today_without_the_new_ones[0]->$today_type_day + (int) $read_today;
        // Save them in db
        Book::update_user_speed_for_today(Auth::id(), $pages_to_add_in_db, Carbon::now()->weekOfYear, lcfirst(Carbon::now()->isoFormat('dddd')), Carbon::now()->year);

        // Check is book is read
        if ($request->up_to_page == $book->pages)
        {
            $data = [
                'up_to_page' => $request->up_to_page,
                'read' => '1'
            ];
        }
        else
        {
            $data = [
                'up_to_page' => $request->up_to_page
            ];
        }
        // Save the book progress in db
        Book::update_up_to_page($data, $book->id, Auth::id());

        return redirect()->route('readlist');
    }

    public function user_speed ()
    {
        $user_speed = Book::get_user_speed_list(Auth::id());

        $now = [
            'week_num' => Carbon::now()->weekOfYear,
            'year' => Carbon::now()->year
        ];

        return view('user_speed.list', compact('user_speed', 'now'));
    }

    public function readlist ()
    {
        $books = Book::get_all_books_with_authors_genres_that_user_read(Auth::id());

        foreach ($books as $book)
        {
            $book->started_to_read = Carbon::parse($book->started_to_read);
            if ($book->ended_to_read !== null)
            {
                $book->ended_to_read = Carbon::parse($book->ended_to_read);
            }
        }

        return view('books.readlist', compact('books'));
    }

    public function delete_book_from_readlist (Book $book)
    {
        $result = Book::delete_book_from_user_read_list(Auth::id(), $book->id);

        if ($result)
        {
            return redirect()->route('readlist')->with(['message'=> "Successfully deleted from readlist!", 'type' =>'success']);
        }
        else
        {
            return redirect()->route('readlist')->with(['message'=> "Something went wrong!", 'type' =>'danger']);
        }
    }
}
