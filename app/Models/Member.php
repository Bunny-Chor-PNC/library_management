<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'age', 'email', 'password'];
    protected function books(){
        return $this->hasMany(Book::class);
    }
    
    protected function borrows(){
        return $this->hasMany(Borrow::class);
    }
}
