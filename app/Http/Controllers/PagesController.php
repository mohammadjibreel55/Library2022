<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Publisher;
use App\Book;

class PagesController extends Controller
{
    public function index()
    {
    	$categories = Category::all();
    	$publishers = Publisher::all();
    	$books = Book::where('is_approved', 1)->orderBy('id', 'desc')->paginate(10);
        return view('frontend.pages.index', compact('books', 'publishers', 'categories'));
    }
}
