@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span>Title: {{ $post->title }}</span>
                        <span>{{ $post->category->title }}</span>
                    </div>
                    <div class="card-body" >
                       ss {{ $post->content }}aa
                    </div>
                    <div class="card-footer">
                        <div>
                            Tags : @foreach($post->tags as $tag)
                                <span class="m-2 btn btn-outline-info">{{$tag->title}}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
