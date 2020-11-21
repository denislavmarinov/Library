<?php

namespace App\Http\Controllers;

use App\Book;
use App\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wishlist = Wishlist::get_all_for_user(Auth::id());

        return view('wishlist.index', compact('wishlist'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $wishlist = [
            'book_id' => $request->book_id,
            'user_id' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now()
        ];

        $result = Wishlist::book_exist_in_wishlist($request->book_id, Auth::id());

        if ($result)
        {
            return redirect()->back()->with(['message' => 'Book already exists in your wishlist!', 'type' =>'warning']);
        }

        $result = Book::check_if_book_is_already_in_readlist($request->book_id, Auth::id());

        if ($result)
        {
            return redirect()->back()->with(['message' => 'Book already exists in your readlist! Go there and read it.', 'type' =>'warning']);
        }

        $result = Wishlist::add_book_to_wishlist($wishlist);

        if ($result)
        {
            return redirect()->route('wishlists.index')->with(['message' => 'Successfully added book to wishlist!', 'type' =>'success']);
        }
        else
        {
            return redirect()->back()->with(['message' => 'Something went wrong!!! Please try agin later!', 'type' =>'danger']);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wishlist $wishlist)
    {
        $result = Wishlist::delete_book_from_wishlist($wishlist->id);

        if ($result)
        {
            return redirect()->route('wishlists.index')->with(['message' => 'Successfully deleted book from wishlist!', 'type' =>'success']);
        }
        else
        {
            return redirect()->back()->with(['message' => 'Something went wrong!!! Please try agin later!', 'type' =>'danger']);
        }
    }
}
