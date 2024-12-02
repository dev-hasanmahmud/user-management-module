@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Role</h1>

        <form action="{{ route('roles.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Role Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="menus">Select Menus</label>
                <select name="menus[]" id="menus" class="form-control" multiple>
                    @foreach ($menus as $menu)
                        <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Create Role</button>
        </form>
    </div>
@endsection
