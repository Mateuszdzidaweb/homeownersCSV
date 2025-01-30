@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen">
    <form action="{{ route('import-csv.import') }}" method="POST" enctype="multipart/form-data" class="max-w-xl mx-auto p-6 border border-gray-300 rounded-lg bg-white shadow-lg">
        @csrf
        <h2 class="text-3xl text-center font-semibold mb-6 text-blue-600">Upload CSV File</h2>
        <label for="file" class="block text-lg mb-2 font-medium text-gray-700">Choose CSV file:</label>
        <input type="file" name="file" accept=".csv" required class="block w-full p-3 mb-6 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200">
        <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200">Upload</button>
    </form>
</div>
@endsection
