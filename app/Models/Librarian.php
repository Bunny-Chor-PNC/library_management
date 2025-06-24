<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Librarian extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'age', 'email', 'password'];
    protected function books()
    {
        return $this->hasMany(Book::class);
    }
    protected function librarians()
    {
        return $this->hasMany(Librarian::class);
    }
    protected function borrows()
    {
        return $this->hasMany(Borrow::class);
    }

    public function getCreatedAtAttribute($value) {
        return date('d-m-Y', strtotime($value));
    }


    public function getUpdatedAtAttribute($value) {
        return date('F d, Y', strtotime($value));
    }

    public function getPriceAttribute($value) {
        return '$' . $value;
    }
}
