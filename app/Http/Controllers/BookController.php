<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Catalog;
use App\Models\Publisher;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publishers = Publisher::all();
        $authors = Author::all();
        $catalogs = Catalog::all();

        return view('admin.book.book', compact('publishers', 'authors', 'catalogs'));
    }

    public function detail_books()
    {
        return view('admin.detail_book.detail_book');
    }

    public function detail_books_api()
    {
        $data_book = Book::with('publisher', 'author', 'catalog')->get();

        return json_encode($data_book);
    }

    public function books_api() {
        $books = Book::with('publisher', 'author', 'catalog')->get();

        $datatables = datatables()->of($books)->addIndexColumn();

        return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'isbn'      => 'required|unique:books',
            'title'     => 'required',
            'year'      => 'required',
            'qty'       => 'required',
            'price'     => 'required',
        ]);

        Book::create([
            'isbn'  => $request->isbn,
            'title'  => $request->title,
            'year'  => $request->year,
            'publisher_id'  => $request->publisher_id,
            'author_id'  => $request->author_id,
            'catalog_id'  => $request->catalog_id,
            'qty'  => $request->qty,
            'price'  => $request->price,
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
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
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {

        $book->update([
            'isbn'  => $request->isbn,
            'title'  => $request->title,
            'year'  => $request->year,
            'publisher_id'  => $request->publisher_id,
            'author_id'  => $request->author_id,
            'catalog_id'  => $request->catalog_id,
            'qty'  => $request->qty,
            'price'  => $request->price,
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
    }
}
