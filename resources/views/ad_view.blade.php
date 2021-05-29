@extends('layout')

@section('content')
    <div class="card" style="margin-bottom: 20px">
        <div class="card-body">
            <h5 class="card-title">{{$post->title}}</h5>
            <p class="card-text">{{$post->description}}</p>
        </div>
        @if(array_key_first($post->tags()->pluck('tag')->toArray()) !== null)
            <div class="card-footer text-muted">
                <h5>Tags</h5>
                @foreach($post->tags()->pluck('tag') as $tag)
                    "{{$tag}}"
                @endforeach
            </div>
        @endif
        <div class="card-footer text-muted">
            {{$post->created_at->diffForHumans()}} by {{$post->user->name}}
        </div>
        @can('delete', $post)
            <div >
                <a href="{{route('delete',[$post->id])}}" class="btn btn-danger">Delete</a>
                <a href="{{route('update',[$post->id])}}" class="btn btn-primary">Update</a>
            </div>
        @endcan
    </div>
@endsection
