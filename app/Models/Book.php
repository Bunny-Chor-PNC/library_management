<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'librarian_id', 'category_id', 'member_id'];

    public function librarian()
    {
        return $this->belongsTo(Librarian::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function borrow()
    {
        return $this->belongsTo(Borrow::class);
    }
}
