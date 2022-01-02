<?php

namespace App\Http\Controllers\Backend;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Book;
use App\Category;
use App\Author;
use App\Models\User;
use App\Publisher;
use App\Translator;

class PagesController extends Controller
{
	function __construct()
	{
		$this->middleware('auth:admin');
	}

    public function index()
    {
    	$total_books = count(Book::all());
    	$total_authors = count(Author::all());
    	$total_publishers = count(Publisher::all());
    	$total_categories = count(Category::all());
        $total_Translators = count(Translator::all());
        $total_Users = count(User::all());
        $total_Admins = count(Admin::all());
return view('backend.pages.index', compact('total_books', 'total_authors', 'total_publishers', 'total_categories','total_Translators','total_Users','total_Admins'));
    }
}
