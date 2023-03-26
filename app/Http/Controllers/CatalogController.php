<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catalogs = Catalog::with('books')->get();

        // send data to view with compact important(compact)
        return view('admin.catalog.catalog', compact('catalogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.catalog.create');
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
            'name'      => ['required'],
        ]);

        // cara pertama harus daftarkan fillable di modal
        // modal eloqouend create
        // Catalog::create([
        //     'name'  => $request->name,
        // ]);

        // cara kedua tidak harus daftarkan fillable
        $catalog = new Catalog;
        $catalog->name = $request->name;
        $catalog->save();

        return redirect('/catalog');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function show(Catalog $catalog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // tampilkan data catalog berdasarkan idnya
        $catalog = Catalog::find($id);

        return view('admin.catalog.edit', compact('catalog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'  => ['required']
        ]);

        $catalog = Catalog::find($id);

        $catalog->name = $request->name;
        $catalog->save();

        return redirect('/catalog');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::where('catalog_id', $id)->update([
            'catalog_id'      => null,
        ]);

        $catalog = Catalog::find($id);
        $catalog->delete();

        return redirect('/catalog');
    }
}
