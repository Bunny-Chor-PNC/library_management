<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['tilte', 'author'];
    protected function librarian()
    {
        return $this->belongsTo(Librarian::class);
    }
    protected function category()
    {
        return $this->belongsTo(Category::class);
    }
    protected function member()
    {
        return $this->belongsTo(Member::class);
    }
    protected function borrow()
    {
        return $this->belongsTo(Borrow::class);
    }

}
