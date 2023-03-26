<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.transaction.transaction');
    }

    public function getApi(Request $request)
    {
        $transaction = Transaction::select('*', DB::raw('datediff(date_end, date_start) as lama_pinjam'))->with('member', 'book');

        if($request->status) {
            $status = $request->status == 'sudah' ? 1 : 0;
            $transaction = $transaction->where('status', '=', $status)->get();
        }

        $datatables = datatables()->of($transaction)->addIndexColumn();

        return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $members = Member::all();
        $books = Book::all();

        return view('admin.transaction.create_transaction', compact('members', 'books'));
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
            'member_id'      => 'required',
            'date_start'     => 'required',
            'date_end'      => 'required',
            'book_id'       => 'required',
        ]);

        $transaction = Transaction::create([
            'date_start'        => $request->date_start,
            'date_end'          => $request->date_end,
            'member_id'         => $request->member_id,
            'status'            => 0
        ]);

        $books = $request->book_id;
        foreach($books as $book) {
            TransactionDetail::create([
                'transaction_id'    => $transaction->id,
                'book_id'           => $book,
                'qty'               => 1
            ]);

            $data_book = Book::find($book);
            $data_book->update([
                'qty'   => $data_book->qty - 1,
            ]);
        };


        return redirect('/transaction');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $transaction = Transaction::with('member', 'book')->where('id', $id)->get();

        return view('admin.transaction.edit_transaction', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $transaction = Transaction::with('member', 'book')->where('id', $id);

        $transaction->update([
            'status'    => $request->status,
        ]);

        if($request->status == 1) {
            $datas = $transaction->get();
            foreach($datas[0]->book as $book) {
                $data_book = Book::find($book->id);
                $data_book->update([
                    'qty'   => $data_book->qty + 1
                ]);
            }
        }

        return redirect('/transaction');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction_detail = TransactionDetail::where('transaction_id', $id);
        $transaction = Transaction::find($id);

        $transaction_detail->delete();
        $transaction->delete();

        return redirect('/transaction');
    }
}
