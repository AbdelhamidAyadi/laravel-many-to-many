@extends('layouts.app')
@section('content')
<div class="container">
    <form action="{{ route('admin.posts.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Post title">
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" id="content" name="content" placeholder="Post content" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" name="category_id">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <p style="font-size: 0.9rem;
        font-weight: 400;
        line-height: 1.6;
        color: #212529;">Tags</p>
        @foreach ($tags as $tag)
        <div class="custom-control custom-checkbox ">

            <input type="checkbox" value="{{ $tag->id }}" name="tags[]" @if ( in_array($tag->id , old('tags' , [])))
            checked
            @endif class="custom-control-input" id="tag_{{$tag->label}}">
            <label class="custom-control-label" for="tag_{{$tag->label}}">{{ $tag->label }}</label>

        </div>
        @endforeach

        <div class="form-group mt-2">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
</div>
@endsection
