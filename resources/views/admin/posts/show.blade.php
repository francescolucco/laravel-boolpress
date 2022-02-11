@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       <div class="col">
          <h1>{{$post->title}}</h1>
          @if ($post->tags)
            @foreach ($post->tags as $post_tag)
            <span class="badge rounded-pill bg-primary">{{$post_tag->name}}</span>
            @endforeach
          @else
            
          @endif
          @if ($post->category)
            <h5 class="py-2"><span class="p-2 badge bg-warning">{{$post->category->name}}</span></h5>
          @endif
          <p>{{$post->description}}</p>
          <p>{{$post->slug}}</p>
          <a href="{{route('admin.posts.edit', $post)}}" type="button" class="btn btn-success">Edit</a>
          <a href="{{route('admin.posts.index')}}" type="button" class="btn btn-secondary">Back</a>
       </div>
   </div>
</div>
@endsection

@section('title')
  {{$post->title}}
@endsection