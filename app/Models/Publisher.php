<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;

    // relasi one to many
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}