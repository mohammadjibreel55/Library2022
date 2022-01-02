<?php

namespace App;

use App\BookAuthor as AppBookAuthor;
use Illuminate\Database\Eloquent\Model;
use App\User;
class Book extends Model

{
    public function category()
    {
    	return $this->belongsTo(Category::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function publisher()
    {
    	return $this->belongsTo(Publisher::class);
    }

    public function authors()
    {
        return $this->hasMany(BookAuthor::class);
    }


    /**
     * isAuthorSelected
     *
     * @param  integer  $book_id
     * @param  integer  $author_id
     * @return boolean            Return true if the author written the book, false otherwise
     */
    public static function isAuthorSelected($book_id, $author_id)
    {
        $book_author = AppBookAuthor::where('book_id', $book_id)->where('author_id', $author_id)->first();
        if (!is_null($book_author)) {
            return true;
        }
        return false;
    }
}
