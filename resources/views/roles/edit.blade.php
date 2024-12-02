@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Role</h1>

        <form action="{{ route('roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Role Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}" required>
            </div>

            <div class="form-group">
                <label for="menus">Select Menus</label>
                <select name="menus[]" id="menus" class="form-control" multiple>
                    @foreach ($menus as $menu)
                        <option value="{{ $menu->id }}" 
                            @if ($role->menus->contains($menu->id)) selected @endif>
                            {{ $menu->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update Role</button>
        </form>
    </div>
@endsection
