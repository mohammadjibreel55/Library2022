<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translator extends Model
{
    public function book()
    {
    	return $this->belongsTo(Book::class);
    }

    use HasFactory;
}
