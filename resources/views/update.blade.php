@extends('layout')

@section('content')
    <form method="POST" action="{{route('update',[$post->id])}}">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            @error('title')
            <div class="alert alert-danger" role="alert">
                {{$message}}
            </div>
            @enderror
            <input type="text" name="title" class="form-control" id="title" aria-describedby="titleHelp"
                   value="{{$post->title}}">
            <small id="titleHelp" class="form-text text-muted">Title</small>
        </div>
        <div class="form-group">
            <label for="description"> Description </label>
            @error('description')
            <div class="alert alert-danger" role="alert">
                {{$message}}
            </div>
            @enderror
            <textarea class="form-control" name="description" id="description"
                      rows="5">{{$post->description}}</textarea>
        </div>
        <label for="tags"> Tags </label>
        @foreach($tags as $tag)
            <div class="form-check">
                @if(in_array($tag->id , $post_tag))
                    <input class="form-check-input" name="tags[]" type="checkbox" value="{{$tag->id}}" checked>
                @else
                    <input class="form-check-input" name="tags[]" type="checkbox" value="{{$tag->id}}">
                @endif
                <label class="form-check-label" for="defaultCheck1">
                    {{$tag->tag}}
                </label>
            </div>
        @endforeach
        <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
        <input type="submit" class="btn btn-primary" value="Update"/>
    </form>
@endsection
