<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    // relasi one to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // relasi hash many transaction
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
