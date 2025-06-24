<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;

    protected $fillable = ['member_id', 'librarian_id', 'book_id'];
    
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function librarian()
    {
        return $this->belongsTo(Librarian::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
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
