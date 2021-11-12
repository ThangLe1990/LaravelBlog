@extends('layouts.app')


@section('content')
    <div class="blog-index">
      <h1>
        Update posts
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
      <form action="/blog/{{ $post->slug }}" method="POST" enctype="multipart/form-data" >
        @csrf
        @method('PUT')

        <input type="text" name="title" style="width: 80%; height: 50px" value="{{ $post->title }}"> <br>
        <textarea name="description" style="width: 80%; height:  300px;" > {{ $post->description }} </textarea> <br>

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