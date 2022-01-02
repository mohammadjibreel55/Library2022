@extends('frontend.layouts.app')

@section('content')
<style>
    .rating-css div {
    color: #ffe400;
    font-size: 30px;
    font-family: sans-serif;
    font-weight: 800;
    text-align: center;
    text-transform: uppercase;
    padding: 20px 0;
  }
  .rating-css input {
    display: none;
  }
  .rating-css input + label {
    font-size: 60px;
    text-shadow: 1px 1px 0 #8f8420;
    cursor: pointer;
  }
  .rating-css input:checked + label ~ label {
    color: #b4afaf;
  }
  .rating-css label:active {
    transform: scale(0.8);
    transition: 0.3s ease;
  }
</style>
<div class="main-content">
    <br>
<br>
<br>

  <div class="book-show-area">
    <div class="container">
      @include('frontend.layouts.partials.messages')
      <div class="row">

        <div class="col-md-3">

          <img src="{{ asset('images/books/'.$book->image) }}" class="img img-fluid" />
        </div>
        <div class="col-md-9">
          <h3>{{ $book->title }}</h3>
          <p class="text-muted">Written By

            @foreach ($book->authors as $book_author)
              <span class="text-primary">{{ $book_author->author->name }}</span>
            @endforeach
             @<span class="text-info">{{ $book->category->name }}</span>
          </p>
          <hr>

          <p><strong>Uploaded By: </strong> {{ $book->user->fname }}</p>
          <p><strong>Uploaded at: </strong> {{ $book->created_at->diffForHumans() }}</p>
          <p>
            <strong>Published at</strong> {{ $book->publish_year }} <br>
            <strong>Publisher: </strong> {{ $book->publisher->name }} <br>
            <strong>ISBN: </strong> {{ $book->isbn }}  <br>
            <span>description  <strong> {!!$book->description!!} </strong></span>


          </p>
          @if (Auth::check())
          <a class="btn btn-primary" target="_blank" href="{{ asset('b/books/'.$book->bookFile) }}">Download E-book</a>


          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Rate the book
          </button>
@else
<button class="btn btn-primary" disabled  target="_blank" href="{{ asset('b/books/'.$book->bookFile) }}">Download E-book</button>
<button class="btn btn-primary" disabled target="_blank" href="{{ route('chatify') }}">Exchange the book from the Chat</button>
<div class="alert alert-warning m-auto mt-4 ">To download the book and exchange books through chat, you must  <a class="font-weight-bold " href="{{route('login')}}">Login</a></div>

          @endif



          {{-- <div class="book-buttons mt-4"> --}}
              {{-- <a href="" class="btn btn-outline-success"><i class="fa fa-check"></i> Already Read</a>
              <a href="book-view.html" class="btn btn-outline-warning"><i class="fa fa-cart-plus"></i> Add to Cart</a>
              <a href="" class="btn btn-outline-danger"><i class="fa fa-heart"></i> Add to Wishlist</a> --}}

              {{-- @auth

              @if ($book->quantity > 0)
                @if (!is_null(App\User::bookRequest($book->id)))

                  @if (App\User::bookRequest($book->id)->status == 1)
                  <span class="badge badge-success" style="padding: 12px;border-radius: 0px;font-size: 14px;">
                    <i class="fa fa-check"></i> Already Requested
                  </span>
                  @endif

                  @if (App\User::bookRequest($book->id)->status == 2)
                  <span class="badge badge-success" style="padding: 12px;border-radius: 0px;font-size: 14px;">
                    <i class="fa fa-check"></i> Owner Confirmed
                  </span>
                  @endif

                  @if (App\User::bookRequest($book->id)->status == 3)
                  <span class="badge badge-danger" style="padding: 12px;border-radius: 0px;font-size: 14px;">
                    <i class="fa fa-times"></i> Owner Rejected
                  </span>
                  @endif


                  @if (App\User::bookRequest($book->id)->status == 4)
                  <span class="badge badge-success" style="padding: 12px;border-radius: 0px;font-size: 14px;">
                    <i class="fa fa-check"></i> Reading...
                  </span>
                  @endif

                 @if (App\User::bookRequest($book->id)->status == 4)
                  <a href="#returnBookModal{{ $book->id }}" class="btn btn-outline-warning" data-toggle="modal"><i class="fa fa-arrow-right"></i> Return Book</a>

                  <div class="modal fade" id="returnBookModal{{ $book->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">
                              Return <mark>{{ $book->title }}</mark>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="{{ route('books.return.store', App\User::bookRequest($book->id)->id) }}" method="post">
                              @csrf

                              <p>
                                Are you sure to return the book ?
                              </p>

                              <button type="submit" class="btn btn-success mt-4">
                                <i class="fa fa-send"></i> Send Return Request
                              </button>

                              <button type="button" class="btn btn-secondary mt-4" data-dismiss="modal">Cancel</button>

                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                 @endif

                  @if (App\User::bookRequest($book->id)->status == 1)

                    <a href="#requestUpdateModal{{ $book->id }}" class="btn btn-outline-success" data-toggle="modal"><i class="fa fa-check"></i> Update Request</a>

                    <form action="{{ route('books.request.delete', App\User::bookRequest($book->id)->id) }}" method="post" style="display: inline-block;">
                      @csrf
                      <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i> Cancel Request</button>
                    </form>


                    <div class="modal fade" id="requestUpdateModal{{ $book->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">
                              Update Request for <mark>{{ $book->title }}</mark>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="{{ route('books.request.update', App\User::bookRequest($book->id)->id) }}" method="post">
                              @csrf

                              <p>
                                Update your request to the owner of this book ?
                              </p>
                              <textarea name="user_message" id="user_message" class="form-control" rows="5" placeholder="Enter your message to the owner (Keep empty if there is no message)" >{{  App\User::bookRequest($book->id)->user_message }}</textarea>

                              <button type="submit" class="btn btn-success mt-4">
                                <i class="fa fa-send"></i> Send Request Now
                              </button>
                              <button type="button" class="btn btn-secondary mt-4" data-dismiss="modal">Cancel</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endif
                @else
                   <a href="#requestModal{{ $book->id }}" class="btn btn-outline-success" data-toggle="modal"><i class="fa fa-check"></i> Send Request</a>

                @endif
                @else
                <span class="badge badge-success" style="padding: 12px;border-radius: 0px;font-size: 14px;">
                  Someone is reading this book ...
                </span>
              @endif


              @endauth





              <div class="modal fade" id="requestModal{{ $book->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">
                        Request for <mark>{{ $book->title }}</mark>
                      </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('books.request', $book->slug) }}" method="post">
                        @csrf

                        <p>
                          Send a request to the owner of this book ?
                        </p>
                        <textarea name="user_message" id="user_message" class="form-control" rows="5" placeholder="Enter your message to the owner (Keep empty if there is no message)" ></textarea>

                        <button type="submit" class="btn btn-success mt-4">
                          <i class="fa fa-send"></i> Send Request Now
                        </button>
                        <button type="button" class="btn btn-secondary mt-4" data-dismiss="modal">Cancel</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>


          </div> --}}
        </div>

      </div>
    </div>
  </div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
          <form action="{{ url('/add-rating') }}" method="POST">
            @csrf
            <input type="hidden" name="book_id" value="{{$book->id}}">
            <input type="hidden" name="user_id" value="{{Auth::id()}}">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Rate the {{$book->title}} book</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="rating-css">
                <div class="star-icon">
                    <input type="radio" value="1" name="product_rating" checked id="rating1">
                    <label for="rating1" class="fa fa-star"></label>
                    <input type="radio" value="2" name="product_rating" id="rating2">
                    <label for="rating2" class="fa fa-star"></label>
                    <input type="radio" value="3" name="product_rating" id="rating3">
                    <label for="rating3" class="fa fa-star"></label>
                    <input type="radio" value="4" name="product_rating" id="rating4">
                    <label for="rating4" class="fa fa-star"></label>
                    <input type="radio" value="5" name="product_rating" id="rating5">
                    <label for="rating5" class="fa fa-star"></label>
                </div>
            </div>
             </div>
             <div class="col-12">
                <label for="summernote">Book comment</label>
                <br>
                <textarea name="comment" id="comment" cols="30" rows="5" class="form-control" placeholder="Book comment"></textarea>
              </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
      </div>
    </div>
  </div>


</div>


@endsection
