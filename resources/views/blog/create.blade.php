@extends('layouts.app')


@section('content')
    <div class="blog-index">
      <h1>
        Create posts
      </h1>
    </div>

     {{-- Hiện lỗi     --}}
    @if ($errors->any())
    <div>
      <ul>
         @foreach ($errors->all() as $error)

        <li style="color: red;">
           {{ $error }} 
        </li>

        @endforeach
      </ul>
    </div>
       
    @endif

    {{-- Form nhập liệu --}}

    <div class="blog-index">
      <form action="/blog" method="POST" enctype="multipart/form-data" >
        @csrf

        <input type="text" name="title" style="width: 80%; height: 50px" placeholder="Title..."> <br>
        <textarea name="description" placeholder="Description" style="width: 80%; height:  300px;"></textarea> <br>

        <div>
          <label for="">
            <span>
              Select a file..
            </span> 

            <input type="file" name="image" class="hidden">
          </label>
        </div> <br>

        <button type="submit" >
          Submit Post
        </button>


      </form>
    </div>
@endsection