<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['date_start', 'date_end', 'member_id', 'status'];

    // hash many revres
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function book()
    {
        return $this->belongsToMany(Book::class, 'transaction_details', 'transaction_id', 'book_id');
    }
}
