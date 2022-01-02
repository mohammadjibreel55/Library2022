@extends('frontend.layouts.app')

@section('content')
<br>

<div class="main-content">

  <div class="login-area page-area">
    <div class="container">
      <div class="row">
          <div class="col-md-8">
            <div class="profile-tab">


              <div class="clearfix"></div>

<h1>Wishlist Page</h1>
     @foreach ($wishlist_books as $book)
     <div class="row">
          <div class="col-md-6">
            <div class="single-book">
              <img src="{{ asset('images/books/'.$book->image) }}" alt="" width="200px" height="300px" class="mt-5 p2">
              <div class="book-short-info">
                <h5>{{ $book->title }}</h5>
                  <a href="{{ route('books.show', $book->slug) }}" class="btn btn-outline-primary"><i class="fa fa-eye"></i> View</a>
              </div>
            </div>
          </div> <!-- Single Book Item -->
      </div>

     @endforeach


            </div>
          </div>

          <div class="col-md-4 p-1">
            @include('frontend.pages.users.partials.sidebar')

          </div>

      </div>
    </div>
  </div>

</div>
@endsection
