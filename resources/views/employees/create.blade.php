<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Add New Employee</h2>

        <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Name field -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold mb-2">Name:</label>
                <input type="text" id="name" name="name" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Email field -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email:</label>
                <input type="email" id="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- User ID field -->
            <div class="mb-4">
                <label for="user_id" class="block text-gray-700 font-semibold mb-2">User ID:</label>
                <input type="number" name="user_id" value="{{ Auth::id() }}" readonly class="w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-100">
            </div>

            <!-- Photo upload -->
            <div class="mb-4">
                <label for="photo" class="block text-gray-700 font-semibold mb-2">Photo:</label>
                <input type="file" name="photo" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Submit button -->
            <div class="mb-6">
                <button type="submit" class="w-full bg-indigo-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-indigo-600 transition duration-300">
                    Add Employee
                </button>
            </div>
        </form>

        <!-- Back link -->
        <div class="text-center">
            <a href="{{ route('employees.index') }}" class="text-indigo-500 hover:underline">Back to Home</a>
        </div>
    </div>

</body>
</html>
