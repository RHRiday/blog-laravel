@extends('layouts.app')

@section('content')
    <div class="jumbotron p-4 p-md-5">
        <div class="px-0">
            <h1 class="display-5 font-weight-bolder font-italic">{{ $data->title }}Contrary to popular belief, Lorem Ipsum
                is not simply
                random text.</h1>
            <div>
                <p class="text-monospace">by <span class="text-muted">Dokko</span> —
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-calendar-event" viewBox="0 0 16 16">
                        <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z" />
                        <path
                            d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                    </svg>
                    {{ date('F j, Y, g:i a', strtotime($data->created_at)) }}
                </p>
                <a href="{{ route('post.edit', $data->id) }}" class="btn btn-primary float-right">Edit</a>
            </div>
            <div class="row">
                <img src="https://static8.depositphotos.com/1263295/875/i/600/depositphotos_8758503-stock-photo-any-questions.jpg"
                    class="img-fluid col-md-8 mx-auto" alt="...">
            </div>
            <p class="lead my-3">{{ $data->description }} Contrary to popular belief, Lorem Ipsum is not simply random
                text.
                It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard
                McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin
                words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical
                literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de
                Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a
                treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem
                ipsum dolor sit amet..", comes from a line in section 1.10.32.
            </p>
        </div>
    </div>
@endsection
