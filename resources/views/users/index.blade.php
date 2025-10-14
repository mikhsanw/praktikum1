@extends('layouts.app')

@section('title', 'Users')
@section('page-title', 'User Management')

{{-- Tambah CSS khusus halaman ini --}}
@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.tailwindcss.min.css">
@endpush

@section('content')
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between mb-4">
            <h2 class="text-lg font-semibold">Users List</h2>
            <a href="{{ route('users.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Add
                User</a>
        </div>

        <table id="usersTable" class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-2 border">ID</th>
                    <th class="p-2 border">Name</th>
                    <th class="p-2 border">Email</th>
                    <th class="p-2 border">Role</th>
                    <th class="p-2 border text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="p-2 border">{{ $user->id }}</td>
                        <td class="p-2 border">{{ $user->name }}</td>
                        <td class="p-2 border">{{ $user->email }}</td>
                        <td class="p-2 border">{{ $user->role }}</td>
                        <td class="p-2 border text-center">
                            <a href="{{ route('users.edit', $user->id) }}" class="text-blue-600 hover:underline">Edit</a> |
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete this user?')"
                                    class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

{{-- Tambah JS khusus halaman ini --}}
@push('scripts')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new DataTable("#usersTable");
        });
    </script>
@endpush
