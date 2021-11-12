@extends('layouts.app')

@section('content')
    <div class="blog-index">
      <div>
        <h1>
          Blog Page
        </h1>
      </div>
    </div>

    @if (session('message'))
        <div class="alert alert-danger">
          <p>
            {{ session('message') }}
          </p>
        </div>
    @endif

    @if (Auth::check())
        <div>
          <h1>
          <a href="/blog/create" >
            Create post
          </a>
          </h1>
        </div>
    @endif
    <br>    
     @foreach ($posts as $post)
    
     <div class="blog-index-2">
      <div>
        <img src="https://st.quantrimang.com/photos/image/2019/03/01/Dark-Mode-khong-giup-cai-thien-thoi-luong-pin-tren-laptop-1.jpg" width="500px" alt="">
      </div>
 

      <div>
        <h2>
          {{ $post->title }}
        </h2>

        <span>
          By: <span>{{ $post->user->name }}</span> <br>
          Created on: <p> {{ date( "F j, Y, g:i a" ,strtotime ($post->created_at) ) }} </p>
        </span>

        <p>
          {{ $post->description }}
        </p>

        <a href="/blog/{{ $post->slug }}">Reading</a> ||

        @if ( isset(Auth::user()->id) && Auth::user()->id == $post->user_id )
            <span >
              <a style="color:royalblue;" href="/blog/{{ $post->slug }}/edit">Edit</a>
            </span> ||
        @endif 

         @if ( isset(Auth::user()->id) && Auth::user()->id == $post->user_id )
            <span>
               <form action="/blog/{{ $post->slug }}" method="POST" >
                @csrf
                @method('delete')

                <button style="color:red;" >Delete</button>

              </form>

            </span>
        @endif


      </div>
    </div>
     
     @endforeach

    
@endsection