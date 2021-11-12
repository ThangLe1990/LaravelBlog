@extends('layouts.app')


@section('content')
  <div class="blog-index">
    <h1>
      {{ $post->title }}
    </h1>
</div> 

<div>
  <span style="color: blue">
    Created By: {{ $post->user->name }} <br>
    Created on: {{ date( "F j, Y" ,strtotime ($post->created_at) ) }}   
  </span> <br>

  <br>
  <p>
    {{ $post->description }}
  </p>

  
</div>


@endsection