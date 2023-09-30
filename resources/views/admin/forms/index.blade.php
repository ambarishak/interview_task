@extends('layouts.admin')

@section('content')
    <div class="col-md-9">
        <h1 class="mb-4">Manage Forms</h1>
        <a href="{{ route('admin.forms.create') }}" class="btn btn-primary mb-3">Create New Form</a>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($forms as $form)
                    <tr>
                        <td>{{ $form->title }}</td>
                        <td>{{ $form->description }}</td>
                        <td>
                            <a href="{{ route('admin.forms.edit', $form->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.forms.destroy', $form->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
