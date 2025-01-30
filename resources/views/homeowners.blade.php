@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h2 class="text-3xl font-semibold text-center mb-6">Homeowners List</h2>

    @if (!empty($data))
        <table class="min-w-full table-auto bg-white border-collapse shadow-lg rounded-lg overflow-hidden">
            <thead>
            <tr class="bg-gray-100">
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Title</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">First Name</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Initial</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Last Name</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $person)
                <tr class="border-t border-gray-200 hover:bg-gray-50">
                    <td class="py-2 px-4 text-sm text-gray-700">{{ $person['title'] ?? '' }}</td>
                    <td class="py-2 px-4 text-sm text-gray-700">{{ $person['first_name'] ?? '' }}</td>
                    <td class="py-2 px-4 text-sm text-gray-700">{{ $person['initial'] ?? '' }}</td>
                    <td class="py-2 px-4 text-sm text-gray-700">{{ $person['last_name'] ?? '' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p class="text-center text-gray-600 mt-4">No data available.</p>
    @endif
</div>
@endsection
