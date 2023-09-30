@extends('layouts.admin')

@section('content')
    <div class="col-md-9">
        <h1 class="mb-4">Create New Form</h1>
        <form action="{{ route('admin.forms.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create Form</button>
        </form>
    </div>
@endsection
