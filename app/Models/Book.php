<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    //relasi one to many revres author
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

     //relasi one to many revres catalog
     public function catalog()
     {
        return $this->belongsTo(Catalog::class);
     }

     //relasi one to many revres publisher
     public function publisher()
     {
        return $this->belongsTo(Publisher::class);
     }

    //  relasi one to many detail transaksi
    public function transaction_details()
    {
        return $this->hasMany(Book::class);
    }

}
