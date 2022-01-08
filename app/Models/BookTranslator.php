<?php

namespace App\Models;

use App\Book;
use App\Translator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookTranslator extends Model
{
    use HasFactory;

    public function book()
    {
    	return $this->belongsTo(Book::class);
    }

    public function translator()
    {
    	return $this->belongsTo(Translator::class);
    }
}
