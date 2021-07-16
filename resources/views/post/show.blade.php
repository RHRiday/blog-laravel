@extends('layouts.app', ['tags' => $tags])

@section('content')
    <div class="jumbotron p-4 p-md-5">
        <div class="px-0">
            <h1 class="display-5 font-weight-bolder font-italic">{{ $data->title }}</h1>
            @if (isset(Auth::user()->id) && Auth::user()->id === $data->user_id)
                <div class="modal fade" id="deletePost" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Confirm delete post?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body alert-danger">
                                You can't undo this action!
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                <form action="{{ route('post.destroy', $data->id) }}">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="float-right">
                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletePost">
                        Delete
                    </button>
                </div>
                <div class="float-right mx-1">
                    <a href="{{ route('post.edit', $data->id) }}" class="btn btn-sm btn-primary">Edit</a>
                </div>
            @endif
            <div class="">
                <p class="text-monospace"><i class="fas fa-user"></i> <span class="text-muted"><a
                            href="/user/{{ $slugName }}">{{ $data->user->name }}</a></span></p>
                <p class="text-monospace">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-calendar-event" viewBox="0 0 16 16">
                        <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z" />
                        <path
                            d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                    </svg>
                    {{ date('F j, Y \a\t g:i A', strtotime($data->created_at)) }}
                </p>
                <p><i class="fas fa-hashtag"></i> <a href="/tag/{{ $data->tag }}">{{ $data->tag }}</a></p>
            </div>
            <div class="row">
                <img src="{{ asset('images/post/' . $data->img_path) }}" class="img-fluid col-md-8 mx-auto" alt="...">
            </div>
            <p class="lead my-3 text-justify">{{ $data->description }}</p>
        </div>
    </div>
    <div class="d-flex {{ isset($next) && !isset($prev) ? 'justify-content-end' : 'justify-content-between' }}">
        <a href="{{ isset($prev) ? route('post.show', $prev) : '' }}"
            class="{{ isset($prev) ? '' : 'd-none' }} btn btn-info">Previous</a>
        <a href="{{ isset($next) ? route('post.show', $next) : '' }}"
            class="{{ isset($next) ? '' : 'd-none' }} btn btn-info">Next</a>
    </div>
@endsection
