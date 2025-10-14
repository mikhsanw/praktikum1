@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white shadow rounded-lg p-4">
        <h2 class="text-lg font-semibold">Total Users</h2>
        <p class="text-2xl font-bold mt-2">120</p>
    </div>
    <div class="bg-white shadow rounded-lg p-4">
        <h2 class="text-lg font-semibold">Active Sessions</h2>
        <p class="text-2xl font-bold mt-2">45</p>
    </div>
    <div class="bg-white shadow rounded-lg p-4">
        <h2 class="text-lg font-semibold">Revenue</h2>
        <p class="text-2xl font-bold mt-2">$3,200</p>
    </div>
</div>

<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-lg font-semibold mb-4">Recent Activity</h2>
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-2 border">User</th>
                <th class="p-2 border">Activity</th>
                <th class="p-2 border">Date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="p-2 border">John Doe</td>
                <td class="p-2 border">Logged In</td>
                <td class="p-2 border">2025-09-08</td>
            </tr>
            <tr>
                <td class="p-2 border">Jane Smith</td>
                <td class="p-2 border">Updated Profile</td>
                <td class="p-2 border">2025-09-07</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
