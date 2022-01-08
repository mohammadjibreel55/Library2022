<?php

namespace App;
use App\Book;
use App\Author;

use Illuminate\Database\Eloquent\Model;

class BookAuthor extends Model
{
    public function book()
    {
    	return $this->belongsTo(Book::class);
    }

    public function author()
    {
    	return $this->belongsTo(Author::class);
    }

}
