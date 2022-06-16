@extends('layouts.app')
@section('content')
<div class="container">
    @if (session('message'))
    <div class="alert alert-success m-4" role="alert">

        {{ session('message') }}

    </div>
    @endif
    <div class="card text-center m-4">
        <div class="card-header">
            
            <h5 class="card-title text-capitalize m-0">{{ $post->title }}</h5>
            <span class="badge p-2  mt-2" style="background-color: {{ $post->category->color }} ; color:white;">{{ $post->category->name }}</span>
            <p style="font-size: 0.9rem;
            font-weight: 400;
            margin:0;
            color: #212529;">Tags:</p>
 
             @forelse ($post->tags as $tag)
             <span class="badge p-2 " style="background-color: {{ $tag->color }} ; color:white;">{{ $tag->label }}</span>
             @empty
             <p style="font-size: 0.9rem;
                 font-weight: 400;
                 margin:0;
                 color: #212529;">There is no tags related to this post</p>
             @endforelse

        </div>
        <div class="card-body">
            <img class="mb-3 rounded" width="50%" src="{{$post->image}}" alt="" srcset="">
            <p class="card-text">{{ $post->content }}</p>
            <a href="{{ route('admin.posts.edit', $post->id ) }}"  class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
            <form class="d-inline" action="{{ route('admin.posts.destroy', $post->id ) }}" method="POST">
                @method('Delete')
                @csrf
                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
            </form>
           
        </div>
        <div class="card-footer text-muted">
            {{ $post->created_at }}
        </div>
    </div>
    
</div>
@endsection
