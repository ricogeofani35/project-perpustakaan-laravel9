<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::all();

        return view('admin.author.author', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.author.create');
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
            'name'      => 'required',
            'email'     => 'required',
            'phone_number'  => 'required',
            'address'   => 'required'
        ]);

        Author::create([
            'name'      =>  $request->name,
            'email'     => $request->email,  
            'phone_number'     => $request->phone_number,  
            'address'     => $request->address,  
        ]);

        return redirect('/author');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $authors = Author::find($id);
        return view('admin.author.edit', compact('authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required',
            'phone_number'  => 'required',
            'address'   => 'required'
        ]);

        Author::where('id', $id)->update([
            'name'      => $request->name,
            'email'      => $request->email,
            'phone_number'      => $request->phone_number,
            'address'      => $request->address,
        ]);

        return redirect('/author');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // update author_id menjadi null
        Book::where('author_id', $id)->update([
            'author_id'     => null,
        ]);

        $author = Author::find($id);
        $author->delete();

        return redirect('/author');
    }
}
