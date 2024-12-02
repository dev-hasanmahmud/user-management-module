<!-- resources/views/menus/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Menu</h1>

        <form action="{{ route('menus.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Menu Name</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>

            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" name="slug" class="form-control" id="slug" required>
            </div>

            <div class="form-group">
                <label for="parent_id">Parent Menu</label>
                <select name="parent_id" class="form-control" id="parent_id">
                    <option value="">None</option>
                    @foreach ($parentMenus as $parentMenu)
                        <option value="{{ $parentMenu->id }}">{{ $parentMenu->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Create Menu</button>
        </form>
    </div>
@endsection
