<!-- resources/views/menus/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Menu</h1>

        <form action="{{ route('menus.update', $menu) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Menu Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $menu->name }}" required>
            </div>

            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" name="slug" class="form-control" id="slug" value="{{ $menu->slug }}" required>
            </div>

            <div class="form-group">
                <label for="parent_id">Parent Menu</label>
                <select name="parent_id" class="form-control" id="parent_id">
                    <option value="">None</option>
                    @foreach ($parentMenus as $parentMenu)
                        <option value="{{ $parentMenu->id }}" {{ $parentMenu->id == $menu->parent_id ? 'selected' : '' }}>
                            {{ $parentMenu->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update Menu</button>
        </form>
    </div>
@endsection
