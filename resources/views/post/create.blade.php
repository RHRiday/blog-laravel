@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-8 mx-auto">
            <div class="justfy-center">
                <h1 class="display-5 bg-dark text-light p-2 text-center">{{ isset($data) ? 'Update blog' : 'Add a Blog' }}
                    @isset($data)
                        <a class="btn btn-sm btn-dark float-right" href="{{ route('post.show', $data->id) }}"><i
                                class="fas fa-reply"></i> Return</a>
                    @endisset
                </h1>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="mb-2 alert alert-danger">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
                <form action="{{ !isset($data) ? route('post.store') : route('post.update', $data->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @isset($data)
                        @method('PUT')
                    @endisset
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{ isset($data) ? $data->title : old('title') }}"
                                placeholder="Write your blog title">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="category">Category</label>
                            <input class="form-control" list="tags" name="tag"
                                value="{{ isset($data) ? $data->tag : old('tag') }}">
                            <datalist id="tags">
                                <option value="Internet Explorer">
                                <option value="Firefox">
                                <option value="Chrome">
                                <option value="Opera">
                                <option value="Safari">
                            </datalist>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="post_desc">Description</label>
                        <textarea class="form-control" id="post_desc" rows="3" name="description"
                            placeholder="Write your blog here">{{ isset($data) ? $data->description : old('description') }}</textarea>
                    </div>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="photo"
                                value="{{ isset($data) ? $data->img_path : old('cover') }}" name="cover">
                            <label class="custom-file-label"
                                for="photo">{{ isset($data) ? 'Change cover photo' : 'Choose cover photo' }}</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary w-100"
                            value="{{ isset($data) ? 'Update blog' : 'Post blog' }}">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
