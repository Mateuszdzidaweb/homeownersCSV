<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSV Homeowners List</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<!-- Main Content Section -->
<div class="min-h-screen flex flex-col">
    <header class="bg-blue-600 text-white py-4">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-3xl font-semibold">CSV Homeowners List</h1>
        </div>
    </header>

    <!-- Main Section -->
    <main class="flex-1">
        <div class="max-w-7xl mx-auto p-6">
            @yield('content')
        </div>
    </main>

    <footer class="bg-gray-800 text-white py-4">
        <div class="max-w-7xl mx-auto text-center">
        </div>
    </footer>
</div>

</body>
</html>
