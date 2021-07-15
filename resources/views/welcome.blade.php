@extends('layouts.app', ['tags' => $tags])

@section('content')
    @if (session()->has('success'))
        <div class="mb-2 alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="row mb-2">
        @forelse ($posts as $post)
            <div class="col-md-6">
                <div
                    class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary">{{ $post->tag }}</strong>
                        <h3 class="mb-0">{{ $post->title }}</h3>
                        <div class="mb-1 text-muted">{{ date('F j', strtotime($post->created_at)) }}</div>
                        <p class="card-text mb-auto">{{ $post->description }}</p>
                        <a href="{{ route('post.show', $post->id) }}" class="stretched-link">Continue reading</a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <img class="bd-placeholder-img" width="200" height="250" src="{{asset('images/post/'.$post->img_path)}}">
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-6">
                No posts found
            </div>
        @endforelse
    </div>
@endsection
