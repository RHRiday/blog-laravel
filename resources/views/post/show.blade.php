@extends('layouts.app', ['tags' => $tags])

@section('content')
    <div class="jumbotron p-4 p-md-5">
        <div class="px-0">
            <h1 class="display-5 font-weight-bolder font-italic">{{ $data->title }}</h1>
                <div class="float-right">
                    <a href="{{ route('post.edit', $data->id) }}" class="btn btn-sm btn-primary">Edit</a>
                </div>
                <div class="">
                    <p class="text-monospace"><i class="fas fa-user"></i> <span
                            class="text-muted">{{ $data->user->name }}</span></p>
                    <p class="text-monospace">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-calendar-event" viewBox="0 0 16 16">
                            <path
                                d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z" />
                            <path
                                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                        </svg>
                        {{ date('F j, Y \a\t g:i A', strtotime($data->created_at)) }}
                    </p>
                    <p><i class="fas fa-hashtag"></i> {{ $data->tag }}</p>
                </div>
            <div class="row">
                <img src="{{ asset('images/post/' . $data->img_path) }}" class="img-fluid col-md-8 mx-auto" alt="...">
            </div>
            <p class="lead my-3">{{ $data->description }}</p>
        </div>
    </div>
@endsection
