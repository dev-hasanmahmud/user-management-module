<!-- resources/views/menus/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Menus</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('menus.create') }}" class="btn btn-primary mb-3">Create New Menu</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Parent Menu</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menus as $menu)
                    <tr>
                        <td>{{ $menu->name }}</td>
                        <td>{{ $menu->slug }}</td>
                        <td>{{ $menu->parent ? $menu->parent->name : 'N/A' }}</td>
                        <td>
                            <a href="{{ route('menus.edit', $menu) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('menus.destroy', $menu) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>

                    @foreach ($menu->children as $child)
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;{{ $child->name }}</td>
                            <td>{{ $child->slug }}</td>
                            <td>{{ $child->parent ? $child->parent->name : 'N/A' }}</td>
                            <td>
                                <a href="{{ route('menus.edit', $child) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('menus.destroy', $child) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
